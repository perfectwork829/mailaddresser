<?php

namespace App\Jobs;

use App\Address;
use App\Notifications\ImportCompleted;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class AddressesImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $path;
    public $tmpPath;

    /**
     * Create a new job instance.
     *
     * @param $path
     */
    public function __construct($path)
    {
        $this->path = $path;
        $this->tmpPath = '/tmp/bizwell/' . $path;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //move file to tmp dir where mysql has access
        if (!is_dir('/tmp/bizwell/addresses'))
            mkdir('/tmp/bizwell/addresses', 0775, true);

        rename(storage_path('app/' . $this->path), $this->tmpPath);

        $sql = "
            LOAD DATA INFILE '$this->tmpPath' IGNORE
            INTO TABLE `addresses`
            FIELDS TERMINATED BY ';'
            ENCLOSED BY '\"'
            LINES TERMINATED BY '\n'
            IGNORE 1 LINES
            (
                id, @vname, @vgender,
                @vmobile1, @vmobile2, @vmobile3, @vmobile4,
                @vphone1, @vphone2, @vphone3,
                @vstreetaddress, @vzipcode, @vtown, @vbirthdate, @vliving
            )
            SET
            name = nullif(@vname, ''),
            gender = nullif(@vgender, ''),
            mobile1 = if(substring(@vmobile1, 1, 2) != '07', null, nullif(@vmobile1, '')),
            mobile2 = if(substring(@vmobile2, 1, 2) != '07', null, nullif(@vmobile2, '')),
            mobile3 = if(substring(@vmobile3, 1, 2) != '07', null, nullif(@vmobile3, '')),
            mobile4 = if(substring(@vmobile4, 1, 2) != '07', null, nullif(@vmobile4, '')),
            phone1 = nullif(@vphone1, ''),
            phone2 = nullif(@vphone2, ''),
            phone3 = nullif(@vphone3, ''),
            streetaddress = nullif(@vstreetaddress, ''),
            zipcode = nullif(@vzipcode, ''),
            town = nullif(@vtown, ''),
            birthdate = nullif(@vbirthdate, ''),
            living = nullif(@vliving, '')
            ;
        ";

        DB::unprepared($sql);

        Notification::route('mail', config('custom.admin_email'))
            ->notify(new ImportCompleted(true, ''));

        rename($this->tmpPath, storage_path('app/' . $this->path));
    }

    public function failed(\Exception $exception)
    {
        rename($this->tmpPath, storage_path('app/' . $this->path));

        Notification::route('mail', config('custom.admin_email'))
            ->notify(new ImportCompleted(false, $exception->getMessage()));
    }
}
