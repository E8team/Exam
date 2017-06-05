<?php

namespace App\Http\Controllers;


use App\Services\DepartmentClassService;
use Illuminate\Http\Request;
use Auth;
use App\Models\Course;
use App\Widgets\Alert;
use Illuminate\Validation\ValidationException;

class CoursesController extends Controller
{

    /**
     * @param bool $isReChoose 是不是重选课程
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function showChooseCourseForm()
    {
        $user = Auth::user();
        $departmentClass = app(DepartmentClassService::class)->getDepartmentClassFromCache($user->department_class_id);
        if (!$user->is_selected_courses) {
            return view('choose', ['user' => $user, 'departmentClass' => $departmentClass]);
        }
        return redirect(url('/'));
    }

    public function showReChooseCourseForm()
    {
        $userSelectedCourses = Auth::user()->courses;
        $courses = Course::all();
        return view('re_choose',['userSelectedCourses'=> $userSelectedCourses, 'courses'=>$courses]);
    }

    public function selectCourses(Request $request)
    {
        try {
          $this->validate($request, [
              'course_ids' => 'required|array'
          ],[
            'course_ids.required' =>'请选择课程'
          ]);
        } catch (ValidationException $e) {
            app(Alert::class)->setDanger($e->validator->errors()->get('course_ids')[0]);
            return redirect()->back();
        }

        $user = Auth::user();
        $user->update(['is_selected_courses' => 1]);
        $user->courses()->attach($request->get('course_ids'));
        return redirect(url('/'));
    }

    public function reSelectCourses(Request $request)
    {
        try {
          $this->validate($request, [
              'course_ids' => 'required|array'
          ],[
            'course_ids.required' =>'请选择课程'
          ]);
        } catch (ValidationException $e) {
            app(Alert::class)->setDanger($e->validator->errors()->get('course_ids')[0]);
            return redirect()->back();
        }

        $user = Auth::user();
        $user->courses()->sync($request->get('course_ids'));
        return redirect(url('/'));
    }
}
