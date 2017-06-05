<?php

namespace App\Http\Controllers;

use App\Services\DepartmentClassService;
use App\Services\MockService;
use App\Services\TopicService;
use App\Widgets\Alert;
use Auth;

class IndexController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function menu($courseId)
    {
        $user = Auth::user();
        if(false===($course = Auth::user()->isSelectedGivenCourse($courseId))){
            app(Alert::class)->setDanger('您没有选择这门课!');
            return abort(404);
        }
        $departmentClass = app(DepartmentClassService::class)->getDepartmentClassFromCache($user->department_class_id);
        //练习
        $practiceInfo = $this->practiceSubmitRecords($courseId);
        //模拟
        $topicInfo = $this->mockSubmitRecord($courseId);
        return view('menu', ['user'=>$user, 'departmentClass' => $departmentClass, 'course'=>$course, 'practiceInfo'=>$practiceInfo, 'topicInfo'=>$topicInfo]);
    }

    /**
     * 统计练习记录
     * @param $courseId
     * @return mixed
     */
    private function practiceSubmitRecords($courseId)
    {
        $topicService = app(TopicService::class);
        $practiceStatistics = $topicService->getPracticeRecords($courseId, Auth::id());
        return $practiceStatistics;
    }

    /**
     * 统计模拟记录
     * @param $courseId
     * @return mixed
     */
    private function mockSubmitRecord($courseId)
    {
        $topic['recordCount'] = 0;// 做的题目总数
        $topic['passCount'] = 0;// 模拟时的及格次数
        $topic['examCount'] = 0;// 累计模拟次数
        $topic['maxScore'] = 0;// 历史最高模拟成绩
        $allMockRecordByUser = app(MockService::class)->allMockRecordByUser(Auth::user(), $courseId);
        foreach ($allMockRecordByUser as $item)
        {
            $topic['recordCount'] += $item->submit_count;
            !($item->score >=60)?: $topic['passCount'] += 1;
            !($item->score > $topic['maxScore']) ?: $topic['maxScore'] = $item->score;
        }
        $topic['examCount'] = count($allMockRecordByUser);
        return $topic;
    }
}
