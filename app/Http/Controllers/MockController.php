<?php

namespace App\Http\Controllers;

use App\Models\MockRecord;
use App\Models\MockTopic;
use App\Services\TopicService;
use Auth;
use Carbon\Carbon;

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
        //dd($mockRecordId);
        $topicService = app(TopicService::class);

        $mockRecord = MockRecord::findOrFail($mockRecordId);
  
        $mockTopics = $mockRecord->mockTopics()->ordered()->limit(config('exam.mock_topics_count'))->get();

        $topics = $topicService->findTopicsFromCache($mockTopics->pluck('topic_id'));
        $topics = $topicService->makeTopicsWithLastSubmitRecord($topics, Auth::user());
        
        return view('mock', ['topics' => $topics, 'remainingTime'=>config('exam.mock_time') - Carbon::now()->diffInSeconds($mockRecord->created_at, true)]);
    }
}