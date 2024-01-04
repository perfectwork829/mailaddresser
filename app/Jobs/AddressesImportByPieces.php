<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;

class AddressesImportByPieces implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $path;
    public $start;
    public $chunk_size = 100000;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($path, $start = 0)
    {
        $this->path = $path;
        $this->start = $start;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Storage::deleteDirectory('addresses/chunks');
        Storage::makeDirectory('addresses/chunks');
        $index = 0;
        $chunkPath = storage_path('app/addresses/chunks/' . $index . '.csv');

        $fp = fopen(storage_path('app/' . $this->path), 'r');
        $dest = fopen($chunkPath, 'w');

        while (false !== ($line = fgets($fp))) {
            $index++;
            if ($index == 1) continue;
            fwrite($dest, $line);

            if ($index % $this->chunk_size == 0) {
                fclose($dest);
                Queue::push(new DispatchImports($chunkPath));
                $chunkPath = storage_path('app/addresses/chunks/' . $index . '.csv');
                $dest = fopen($chunkPath, 'w');
            }
        }

        fclose($fp);
        fclose($dest);
        Queue::push(new DispatchImports($chunkPath));
    }
}
