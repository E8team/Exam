<?php

namespace App\Http\Controllers;


use App\Services\DepartmentClassService;
use Illuminate\Http\Request;
use Auth;

class CoursesController extends Controller
{

    /**
     * @param bool $isReChoose 是不是重选课程
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function showChooseCourseForm($isReChoose = false)
    {
        $user = Auth::user();
        $departmentClass = app(DepartmentClassService::class)->getDepartmentClassFromCache($user->department_class_id);
        if(false == $isReChoose){
            if(!$user->is_selected_courses){
                return view('choose', ['user' => $user,'departmentClass' => $departmentClass]);
            }
        }else{
            return view('re_choose', ['user' => $user,'departmentClass' => $departmentClass]);
        }
        return redirect(url('/'));
    }

    public function showReChooseCourseForm()
    {
        $this->showChooseCourseForm(true);
    }

    public function selectCourses(Request $request)
    {
        $this->validate($request, [
            'course_ids' => 'required|array'
        ]);
        $user = Auth::user();
        $user->update(['is_selected_courses'=>1]);
        $user->courses()->attach($request->get('course_ids'));
        return redirect(url('/'));
    }
    public function reSelectCourses(Request $request)
    {
        $this->validate($request, [
            'course_ids' => 'required|array'
        ]);
        $user = Auth::user();
        $user->courses()->detach();
        $this->selectCourses($request);
        return redirect(url('/'));
    }
}
