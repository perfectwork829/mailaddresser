<?php

namespace App\Jobs;

use App\Address;
use App\Notifications\ImportCompleted;
use App\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Notification;

class AddressesImportCompleted implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $filename;

    /**
     * Create a new job instance.
     *
     * @param $filename
     */
    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $rows = Address::count();

        Notification::route('mail', config('custom.admin_email'))
            ->notify(new ImportCompleted($this->filename, $rows));

        Setting::updateOrInsert(
            ['key' => 'import_running'],
            ['value' => '0']
        );

        Cache::flush();
    }
}
