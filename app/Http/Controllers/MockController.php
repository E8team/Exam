<?php

namespace App\Http\Controllers;

use App\Models\MockRecord;
use App\Models\MockTopic;
use App\Services\TopicService;
use Auth;
use Carbon\Carbon;
use Gate;

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
        if(Gate::denies('mock', $mockRecord)){
            //todo alert
            abort(404);
        }
        $user = Auth::user();
        $topicService = app(TopicService::class);

        $mockTopics = $mockRecord->mockTopics()->ordered()->limit(config('exam.mock_topics_count'))->get();
        $topics = $topicService->findTopicsFromCache($mockTopics->pluck('topic_id'));

        $topics = $topicService->makeTopicsWithLastSubmitRecord($topics, 'mock', $user);
        return view('mock', ['topics' => $topics, 'mockRecord'=>$mockRecord, 'remainingTime'=>config('exam.mock_time') - Carbon::now()->diffInSeconds($mockRecord->created_at, true)]);
    }

    public function endMock($mockRecordId)
    {
        $mockRecord = MockRecord::findOrFail($mockRecordId);
        if(Gate::denies('mock', $mockRecord)){
            //todo alert
            abort(404);
        }
        $user = Auth::user();
        $topicService = app(TopicService::class);
        $mockTopics = $mockRecord->mockTopics()->ordered()->limit(config('exam.mock_topics_count'))->get();
        $topics = $topicService->findTopicsFromCache($mockTopics->pluck('topic_id'));
        $topics = $topicService->makeTopicsWithLastSubmitRecord($topics, 'mock', $user);
        foreach ($topics as $topic){
            dd($topics->submitReocrds);
        }
        $mockRecord->ended_at = Carbon::now();
        $mockRecord->save();
        MockTopic::where('mock_record_id', $mockRecord)->delete();

    }
}
