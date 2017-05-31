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
        MockTopic::insert($data);
        return redirect(route('mock', ['mockRecordId'=>$mockRecord->id]));
    }

    public function showMockView($mockRecordId)
    {
        $mockRecord = MockRecord::findOrFail($mockRecordId);
        $mockTopics = $mockRecord->mockTopics()->ordered()->limit(config('exam.mock_topics_count'))->get();
        $topics = app(TopicService::class)->findTopicsFromCache($mockTopics->pluck('topic_id'));
        return view('mock', ['topics' => $topics]);
    }
}