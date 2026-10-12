<?php

namespace App\Events;

use App\Models\News;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewsCreated
{

    /**
     * Create a new event instance.
     */
    public function __construct(public News $news)
    {
        //
    }

}
