<?php

namespace App\Http\Controllers;


use App\Services\DepartmentClassService;
use Illuminate\Http\Request;
use Auth;

class CoursesController extends Controller
{

    public function showChooseCourseForm()
    {

        $user = Auth::user();
        if(!$user->is_selected_courses){
            $departmentClass = app(DepartmentClassService::class)->getDepartmentClassFromCache($user->department_class_id);
            return view('choose', ['user' => $user,'departmentClass' => $departmentClass]);
        }
        return redirect(url('/'));
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
}
