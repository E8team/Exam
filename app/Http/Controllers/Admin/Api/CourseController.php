<?php


namespace App\Http\Controllers\Admin\Api;


use App\Services\Admin\CourseService;

class CourseController  extends ApiController
{
    /**
     * 返回课程列表
     * @param CourseService $courseService
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function lists(CourseService $courseService)
    {
        $courses = $courseService->getCourses();
        return $courses;
    }

    /**
     * 查询选$CourseId课程的学生
     * @param CourseService $courseService
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getCourse(CourseService $courseService , $CourseId)
    {
        //$CourseId = 2;
        //dd($courseService->getCourses($CourseId)->toArray());
        return $courseService->getCourses($CourseId);
    }

}