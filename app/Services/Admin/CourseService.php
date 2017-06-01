<?php
/**
 * Created by PhpStorm.
 * User: Lei
 * Date: 2017/5/31
 * Time: 19:44
 */

namespace App\Services\Admin;

use App\Models\Course;

class CourseService
{
    public function getCourses($CoursesId = null)
    {
        if(empty($CoursesId)){
            return Course::all();
        }else{
            return Course::findOrFail($CoursesId)->load('users');
        }
    }

}