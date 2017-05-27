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
     * @param $event
     * @return void
     */
    public function handle($event)
    {
        if($event instanceof SubmitedTopic){
            $event->topic->total_submit_count++;
            if($event->submitRecord->is_correct){
                $event->topic->correct_submit_count++;
            }
            $event->topic->save();
        }
    }
}
