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
    public function getStudent()
    {
        $userId = 1;
        dd( app(UserService::class)->findUser($userId)->toArray());
    }


    public function getSubmitRelated()
    {
        dd(app(UserService::class)->getAvgCount(40));
    }
}