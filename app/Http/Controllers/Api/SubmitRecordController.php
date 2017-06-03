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
        $userId = Auth::id();
        /**
         * 模拟的时候，这里判断当前登录的用户是否已经提交过该题目。 为了防止用户重复提交
         */
        if(!($data['type']=='mock' && $this->userIsSubmibedTopic($data['topic_id'], $userId)))
        {
            $correctOption = $topic->options->where('is_correct', true)->first();
            $data['is_correct'] = $correctOption->id == $data['selected_option_id'];
            $data['user_id'] = $userId;
            $submitRecord = SubmitRecord::create($data);
            event(new SubmitedTopic($topic, $submitRecord));


            return [
                'is_correct' => $submitRecord->is_correct,
                'correct_option_ans' => $topic->getAns()
            ];
        }
        return $this->response->noContent();
    }

    private function userIsSubmibedTopic($topicId, $userId)
    {
        return SubmitRecord::where(['user_id' => $userId,'topic_id' =>$topicId,'type' =>'mock'])->first();
    }

}
