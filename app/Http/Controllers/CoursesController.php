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
            $department_class_id = $user->department_class_id;
            $department = app(DepartmentClassService::class)->getDepartmentClassFromCache($department_class_id)->toArray();
            $user_class = array();
            $user_class['department'] = array_get($department,'parent.parent.parent.title',null);
            $user_class['major'] = array_get($department,'parent.parent.title',null);
            $user_class['grade'] = array_get($department,'parent.title',null);
            $user_class['class'] = array_get($department,'title',null);
            return view('choose', ['user' => Auth::user(),'user_class' => $user_class]);
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