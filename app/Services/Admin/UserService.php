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
     * 返回学生所有信息(所选课程,系别)
     * @param null $userId
     * @return mixed
     */
    public function findUser($userId = null)
    {
        if(!empty($userId)){
            return User::findOrFail($userId)->load('courses')->load('departmentClass');
        }else{
            return User::all()->load('courses')->load('departmentClass');
        }

    }

    /**
     * --
     * 返回$userId提交信息
     * @param  $userId
     * @return $this
     */
    public function getSubmitRelated($userId)
    {
        return User::findOrFail($userId)->load('submitRecords');
    }

    /**
     * --
     * 查询$userId的提交总数，和正确率
     * @param $userId
     * @return array
     */
    public function getAvgCount($userId)
    {
        $submits = $this->getSubmitRelated($userId)->toArray();
        $count = count($submits['submit_records']);
        $num = 0;
        foreach ($submits['submit_records'] as $submit){
            if($submit['is_correct'] == 'true'){
                $num++;
            }
        }
        $avg = round($num/$count*100 , 2 ).'%';
        $information = ['count'=>$count , 'avg'=>$avg];

        return $information;
    }






}