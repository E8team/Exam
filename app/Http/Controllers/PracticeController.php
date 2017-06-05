<?php

namespace App\Http\Controllers;

use App\Models\Course;
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

        return redirect(route('menu',['courseId'=>$courseId]));
    }

    public function showPracticeView($courseId)
    {
        $user = Auth::user();
        $topicService = app(TopicService::class);

        $practiceTopicIds = $topicService->getTopicIdsByCourseFromCache($courseId);
        $topics = $topicService->getPaginator($practiceTopicIds, $this->perPage());
        $topics->setCollection($topicService->makeTopicsWithLastSubmitRecord($topics, 'practice', $user->id));
        $practiceRecords = SubmitRecord::byUser($user)->practice()->get();
        return view('exercise', [
            'topics' => $topics,
            'practiceRecords' =>$practiceRecords,
        ]);

    }


}
