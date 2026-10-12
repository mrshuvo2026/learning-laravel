<?php

namespace App\Jobs;

use App\Models\News;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendNewsNotification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public News $news)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        file_put_contents(
            storage_path('logs/job-test.txt'),
            "Job Executed\n",
            FILE_APPEND
        );
      
    }
    public function failed(\Throwable $exception):void
    {
        \Log::error('SendNewsNotification Job Failed: ' . $exception->getMessage());
    }
}
