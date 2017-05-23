<?php

namespace App\Listeners;

use App\Events\SubmitedTopic;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TopicListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SubmitedTopic  $event
     * @return void
     */
    public function handle(SubmitedTopic $event)
    {
        //
    }
}
