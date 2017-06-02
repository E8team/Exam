<?php

namespace App\Transformers;


use App\Models\Topic;
use League\Fractal\TransformerAbstract;

class TopicTransformer extends TransformerAbstract
{
    public function transform(Topic $topic)
    {
        return [
            'id' => $topic->id,
            'topic_num' => $topic->topic_num,
            'title' => $topic ->title,
            'course_id' => $topic->course_id,
            'correct_submit_count' => $topic->correct_submit_count,
            'total_submit_count'=>$topic->total_submit_count
        ];
    }
}