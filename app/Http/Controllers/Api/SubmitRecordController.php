<?php

namespace App\Http\Controllers\Api;


use App\Events\SubmitedTopic;
use App\Http\Requests\SubmitRecordRequest;
use App\Models\SubmitRecord;
<<<<<<< HEAD
=======
use App\Models\Topic;
use App\Models\User;
>>>>>>> 15289d6da8c4efb3116682937098ab007002ac1e
use App\Services\TopicService;
use Illuminate\Support\Facades\Auth;

class SubmitRecordController extends ApiController
{

    public function submit(SubmitRecordRequest $request)
    {
        $data = $request->all();
        $topicService = app(TopicService::class);
        $topic = $topicService->findTopicFromCache($data['topic_id']);
        $userId = Auth::id();
        /**
         * 模拟的时候，这里判断当前登录的用户是否已经提交过该题目。 为了防止用户重复提交
         */
        if(!($data['type']=='mock' && $this->isSubmibedWithTopic($data['topic_id'], $userId)))
        {
            $correctOption = $topic->options->where('is_correct', true)->first();
            $data['is_correct'] = $correctOption->id == $data['selected_option_id'];
            $data['user_id'] = $userId;
            $submitRecord = SubmitRecord::create($data);
            event(new SubmitedTopic($topic, $submitRecord));
        }
        return $this->response->noContent();
    }

    private function userIsSubmibedTopic($topicId, $userId)
    {
<<<<<<< HEAD
        return SubmitRecord::where(['user_id' =>Auth::user()->id,'topic_id' =>$topic->id])->mock()->first();
=======
        return SubmitRecord::where(['user_id' => $userId,'topic_id' =>$topicId,'type' =>'mock'])->first();
>>>>>>> 15289d6da8c4efb3116682937098ab007002ac1e
    }

}
