<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\MockRecord;
use App\Models\MockTopic;
use App\Services\MockService;
use App\Services\TopicService;
use Auth;
use Carbon\Carbon;
use Gate;

class MockController extends Controller
{

    public function createMock($courseId)
    {
        $user = Auth::user();

        $mockRecord = MockRecord::create(['user_id'=>$user->id, 'course_id'=>$courseId]);

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

        if(!is_null($mockRecord->ended_at)){
            return redirect(route('end_mock', ['mockRecordId'=>$mockRecordId]));
        }
        $topicService = app(TopicService::class);

        $mockTopics = $mockRecord->mockTopics()->ordered()->limit(config('exam.mock_topics_count'))->get();

        $topics = $topicService->findTopicsFromCache($mockTopics->pluck('topic_id'));

        $topics = $topicService->makeTopicsWithLastSubmitRecord($topics, 'mock', $mockRecordId);
        return view('mock', [
            'topics' => $topics,
            'mockRecord'=>$mockRecord,
            'remainingTime'=>config('exam.mock_time') - Carbon::now()->diffInSeconds($mockRecord->created_at, true)
        ]);
    }

    public function endMock($mockRecordId)
    {
        $mockRecord = MockRecord::findOrFail($mockRecordId);
        if(Gate::denies('mock', $mockRecord)){
            //todo alert
            abort(404);
        }
        $mockTopicsCount = config('exam.mock_topics_count');
        if(is_null($mockRecord->ended_at)){
            // 计算模拟得分
            $mockRecord->score = $mockRecord->correct_count/$mockTopicsCount*100;
            $mockRecord->ended_at = Carbon::now();
            $mockRecord->save();
            MockTopic::where('mock_record_id', $mockRecord->id)->delete();
        }
        $wrongCount =  $mockRecord->submit_count - $mockRecord->correct_count;
        return view('score', [
            'mockRecord'=>$mockRecord,
            'wrongCount' => $wrongCount,
            'mockTopicsCount'=>$mockTopicsCount
        ]);
    }
}
