<?php

namespace App\Http\Controllers;


use App\Models\MockRecord;
use App\Models\MockTopic;
use App\Services\TopicService;
use Auth;

class MockController extends Controller
{

    public function createMock($courseId)
    {
        $user = Auth::user();

        $mockRecord = MockRecord::create(['user_id'=>$user->id]);

        $topicService = app(TopicService::class);
        // 创建mock
        $topicIds = $topicService->randomTopicIds($user, $courseId, config('exam.mock_topics_count'));
        $data = [];
        $i = 1;
        foreach ($topicIds as $topicId){
            $data[] = [
                'mock_record_id' => $mockRecord->id,
                'topic_id' => $topicId,
                'order' => $i++
            ];
        }
        MockTopic::create($data);
        return redirect(route('create_mock'));
    }

    public function showMockView($mockRecordId)
    {
        $mockTopics = MockTopic::where('mock_record_id', $mockRecordId)->ordered()->limit(config('exam.mock_topics_count'))->get();
        return view('mock', ['mockTopics' => $mockTopics]);
    }
}