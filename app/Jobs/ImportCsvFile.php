<?php

namespace App\Jobs;

use App\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ImportCsvFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $csvFilePath;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($csvFilePath)
    {
        $this->csvFilePath = $csvFilePath;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
    if (($handle = fopen ( $this->csvFilePath, 'r' )) !== FALSE) {
      while ( ($data = fgetcsv ( $handle, 1000, ',' )) !== FALSE ) {
        $subscriber = new Subscriber ();
        $subscriber->firstname = $data [1];
        $subscriber->lastname = $data [2];
        $subscriber->email = $data [3];
        $subscriber->save ();
  
      }
      fclose ( $handle );
      
    }
    }
}
