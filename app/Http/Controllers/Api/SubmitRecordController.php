<?php

namespace App\Http\Controllers\Api;


use App\Events\SubmitedTopic;
use App\Http\Requests\SubmitRecordRequest;
use App\Models\SubmitRecord;
use App\Services\TopicService;
use Illuminate\Support\Facades\Auth;

class SubmitRecordController extends ApiController
{

    public function submit(SubmitRecordRequest $request)
    {
        $data = $request->all();
        $topicService = app(TopicService::class);
        $topic = $topicService->findTopicFromCache($data['topic_id']);
        if(!$this->isSubmibedWithTopic($topic))
        {
            $correctOption = $topic->options->where('is_correct', true)->first();
            if($correctOption->id == $data['selected_option_id']){
                $data['is_correct'] = true;
            }else{
                $data['is_correct'] = false;
            }
            $data['user_id'] = 1;// Auth::id();
            $submitRecord = SubmitRecord::create($data);
            event(new SubmitedTopic($topic, $submitRecord));
        }
        return $this->response->noContent();
    }

    private function isSubmibedWithTopic(TopicService $topic)
    {
        return SubmitRecord::where(['user_id' =>Auth::user()->id,'topic_id' =>$topic->id])->mock()->first();
    }

}
