<?php

namespace App\Http\Controllers;


use App\Events\SubmitedTopic;
use App\Http\Requests\SubmitRecordRequest;
use App\Models\SubmitRecord;
use App\Services\TopicService;
use Auth;

class SubmitRecordController
{

    public function submit(SubmitRecordRequest $request)
    {
        $data = $request->all();
        $topicService = app(TopicService::class);
        $topic = $topicService->getTopicFromCache($data['topic_id']);
        $correctOption = $topic->options->where('is_correct', true)->first();
        if($correctOption->id == $data['selected_option_id']){
            $data['is_correct'] = true;
        }else{
            $data['is_correct'] = false;
        }
        $data['user_id'] = Auth::id();
        $submitRecord = SubmitRecord::create($data);
        event(new SubmitedTopic($topic, $submitRecord));
    }

}