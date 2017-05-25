<?php

namespace App\Events;


use App\Models\SubmitRecord;
use App\Models\Topic;

class SubmitedTopic
{

    public $topic;
    public $submitRecord;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Topic $topic, SubmitRecord $submitRecord)
    {
        $this->topic = $topic;
        $this->submitRecord = $submitRecord;
    }

}
