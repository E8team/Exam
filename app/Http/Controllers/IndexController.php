<?php

namespace App\Http\Controllers;

use App\Services\DepartmentClassService;
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
        $practiceInfo = $this->practiceSubmitRecords($courseId);
        return view('menu', ['user'=>$user, 'departmentClass' => $departmentClass, 'course'=>$course, 'practiceInfo'=>$practiceInfo]);
    }

    public function practiceSubmitRecords($courseId)
    {
        $topicService = app(TopicService::class);
        $parctice = new Collection();
        $parctice->correct = 0;
        $parctice->mistake = 0;
        $topicIds = $topicService->getTopicIdsByCourseFromCache(1);
        $submitRecords = $topicService->makeTopicsWithLastSubmitRecord($topicIds,'practice',Auth::user())->toArray();
        dd($submitRecords);
        foreach ($submitRecords as $submitRecord)
        {
          if(!empty($submitRecord['submit_record'])){
              !isset($submitRecord['submit_record'][0]['is_correct']) ? $parctice->mistake++ : $parctice->correct++;
          }
        }
        $parctice->unfinished = 500 - $parctice->correct-$parctice->mistake;
        $parctice->correct_rate = round(($parctice->correct / 500)*100);
        $parctice->unfinished_rate = round(($parctice->unfinished / 500)*100);
        $parctice->mistake_rate = round(($parctice->mistake / 500)*100);
        return $parctice;
    }
}
