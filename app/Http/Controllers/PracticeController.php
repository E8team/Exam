<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\PracticeSubmitCount;
use App\Models\SubmitRecord;
use App\Services\TopicService;
use Auth;

class PracticeController extends Controller
{

    public function resetPracticeRecords($courseId)
    {
        $user = Auth::user();

        $topicService = app(TopicService::class);

        $topicService->resetPracticeRecords($courseId, $user);

        return redirect(route('practice',['courseId'=>$courseId]));
    }

    public function showPracticeView($courseId)
    {
        $user = Auth::user();
        $topicService = app(TopicService::class);

        $practiceTopicIds = $topicService->getTopicIdsByCourseFromCache($courseId);
        $topics = $topicService->getPaginator($practiceTopicIds, $this->perPage());
        $topics->setCollection($topicService->makeTopicsWithLastSubmitRecord($topics, 'practice', $user->id));
        $practiceSubmitCount = PracticeSubmitCount::firstOrCreate(['user_id'=>$user->id, 'course_id'=>$courseId],
            [
                'user_id' => $user->id,
                'course_id' => $courseId,
                'correct_count' => 0,
                'submit_count' => 0
            ]);
        return view('exercise', [
            'topics' => $topics,
            'practiceSubmitCount' =>$practiceSubmitCount,
            'courseId' => $courseId
        ]);

    }


}
