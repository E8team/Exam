<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\SubmitRecord;
use App\Services\TopicService;
use Auth;

class PracticeController extends Controller
{

    /*public function createPractice($courseId)
    {
        $user = Auth::user();

        $topicService = app(TopicService::class);

        $topicIds = $topicService->randomTopicIds($user, $courseId, config('exam.mock_topics_count'));
        return redirect(route('mock', ['mockRecordId'=>$mockRecord->id]));
    }*/

    public function showPracticeView($courseId)
    {
        $course = Course::find($courseId);
        $user = Auth::user();
        $topicService = app(TopicService::class);

        $practiceTopicIds = $topicService->getTopicIdsByCourseFromCache($courseId);
        $topics = $topicService->getPaginator($practiceTopicIds, $this->perPage());
        $topics->setCollection($topicService->makeTopicsWithLastSubmitRecord($topics, 'practice', $user->id));
        //var_dump($topics->toArray());
        //return ($topics->links());
        $practiceRecords = SubmitRecord::byUser($user)->practice()->get();
        //$practiceRecords = $practiceRecords->unique('topic_id');
        return view('exercise', [
            'topics' => $topics,
            'practiceRecords' =>$practiceRecords,
        ]);

    }

   /* public function endMock($mockRecordId)
    {
        $mockRecord = MockRecord::findOrFail($mockRecordId);
        if(Gate::denies('mock', $mockRecord)){
            //todo alert
            abort(404);
        }
        $mockTopicsCount = config('exam.mock_topics_count');
        if(is_null($mockRecord->ended_at)){
            $submitRecords = $mockRecord->submitRecords;
            $submitRecords = $submitRecords->unique('topic_id');
            $mockRecord->submit_count = $submitRecords->count();
            $mockRecord->correct_count = $submitRecords->where('is_correct', true)->count();
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
    }*/
}
