<?php

namespace App\Http\Controllers;


use App\Http\Requests\SubmitRecordRequest;
use App\Services\TopicService;

class SubmitRecordController
{

    public function submit(SubmitRecordRequest $request)
    {
        $data = $request->all();
        $topicService = app(TopicService::class);
        $topic = $topicService->getTopicFromCache($data['topic_id']);

    }

}