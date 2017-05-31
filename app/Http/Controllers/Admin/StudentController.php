<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2017/5/27
 * Time: 23:51
 */

namespace App\Http\Controllers\Admin;


use App\Models\User;
use App\Services\Admin\CourseService;
use App\Services\admin\UserService;

class StudentController extends Controller
{
    public function getUsers()
    {
        dd( app(UserService::class)->getUsers()->toArray());
    }

    public function getSubmitRelated()
    {
        $userId = 1;
        dd(app(UserService::class)->getCorrectRate($userId));
    }

    public function getCourseStudent()
    {
        dd(app(CourseService::class)->getCourses()->toArray());
    }
}