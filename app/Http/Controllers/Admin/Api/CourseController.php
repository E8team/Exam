<?php


namespace App\Http\Controllers\Admin\Api;


use App\Services\Admin\CourseService;

class CourseController  extends ApiController
{
    public function getAllCourses(CourseService $courseService)
    {
        $courses = $courseService->getCourses();
        return $courses;
    }

    /**
     * 查询选$CourseId课程的学生
     * @param CourseService $courseService
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getCourse(CourseService $courseService)
    {
        $CourseId = 2;
        return $courseService->getCourses($CourseId);
    }

}