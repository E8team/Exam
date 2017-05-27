<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2017/5/27
 * Time: 20:35
 */

namespace App\Services\Admin;


use App\Models\User;

class UserService
{
    /**
     * --
     * 返回所有学生
     * @return mixed
     */
    public function allUser()
    {
        return User::all()->load('courses')->load('departmentClass');
    }

    /**
     * --
     * 根据ID返回学生
     * @param $userId
     * @return mixed
     */
    public function findUser($userId)
    {

        return User::findOrFail($userId)->load('courses')->load('departmentClass');
    }


}