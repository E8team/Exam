<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2017/5/27
 * Time: 23:51
 */

namespace App\Http\Controllers\Admin;


use App\Services\admin\UserService;

class StudentController extends Controller
{
    /**
     * --
     * 返回所有学生的信息，包括系别，所选课程
     */
    public function getAllStudent()
    {
        dd(app(UserService::class)->allUser()->toArray());
    }

    /**
     * --
     * 根据ID返回学生所有信息，包括系别，所选课程
     */
    public function getStudent()
    {
        dd( app(UserService::class)->findUser(2)->toArray());
    }
}