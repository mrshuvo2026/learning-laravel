<?php

namespace App\Listeners;
use App\Events\NewsCreated;

class LogNewsCreated
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewsCreated $event): void
    {
        $news = $event->news;
        \Log::info("New News Created: " . $news->title);
    }
}
