<?php

namespace App\Http\Controllers;


use App\Models\Topic;
use App\Models\User;
use App\Services\DepartmentClassService;
use App\Services\MockService;
use App\Services\TopicService;
use App\Widgets\Alert;
use Illuminate\Http\Request;
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
        // /create_mock/course/{courseId}
        $departmentClass = app(DepartmentClassService::class)->getDepartmentClassFromCache($user->department_class_id);
        return view('menu', ['user'=>$user, 'departmentClass' => $departmentClass, 'course'=>$course]);
    }

    public function test(Request $request)
    {
        dd(app(MockService::class)->getCorrectTopicCount(User::find(1)));
        //dd(app(TopicService::class)->findTopicsFromCache(app(TopicService::class)->randomTopicIds(\App\Models\User::find(1),1)));
    }

}
