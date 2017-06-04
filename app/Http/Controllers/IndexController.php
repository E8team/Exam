<?php

namespace App\Http\Controllers;

use App\Models\MockRecord;
use App\Models\Topic;
use App\Services\DepartmentClassService;
use App\Services\MockService;
use App\Services\TopicService;
use App\Widgets\Alert;
use Auth;
use Illuminate\Support\Collection;

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

    private function practiceSubmitRecords($courseId)
    {
        $topicService = app(TopicService::class);
        $parctice = new Collection();
        $parctice->correct = 0;
        $parctice->mistake = 0;
        $topicIds = $topicService->getTopicIdsByCourseFromCache($courseId);
        $topicIds = $topicService->makeTopicsWithLastSubmitRecord($topicIds,'practice',Auth::user());
        foreach ($topicIds as $topicId)
        {
          if(!$topicId->submitRecords->isEmpty()){
              $topicId->submitRecords->first()->is_correct ? $parctice->mistake++ : $parctice->correct++;
          }
        }
        $parctice->unfinished = 500 - $parctice->correct-$parctice->mistake;
        $parctice->correct_rate = $parctice->correct / 500 * 100;
        $parctice->unfinished_rate = $parctice->unfinished / 500 * 100;
        $parctice->mistake_rate = $parctice->mistake / 500 * 100;
        return $parctice;
    }

    private function mockSubmitRecord($courseId)
    {
        $topicService = app(TopicService::class);
        $topicIds = $topicService->getTopicIdsByCourseFromCache($courseId);
        $topic = new Collection();
        $topic->recordCount = 0;// 做的题目总数
        $topic->passCount = 0;// 模拟时的及格次数
        $topic->examCount = 0;// 累计模拟次数
        $topic->maxScore = 0;// 历史最高模拟成绩
        $allMockRecordByUser = app(MockService::class)->allMockRecordByUser(Auth::user());
        foreach ($allMockRecordByUser as $item)
        {
            $topic->recordCount += $item->submit_count;
            !($item->score >=60)?: $topic->passCount+=1;
            !($item->score > $topic->maxScore)?:$topic->maxScore=$item->score;
        }
        $topic->examCount = count($allMockRecordByUser);
        return $topic;
    }
}
