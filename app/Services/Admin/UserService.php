<?php


namespace App\Services\Admin;


use App\Models\User;

class UserService
{
    /**
     * 返回学生所有信息(所选课程,系别)
     * @param null $userId
     * @return mixed
     */
    public function getUsers($userId = null)
    {
        if(!empty($userId)){
            return User::findOrFail($userId)->load(['courses','departmentClass']);
        }else{
            return User::all()->load(['courses','departmentClass']);
        }
    }


    public function getSubmitRelated($userId)
    {
        return User::findOrFail($userId)->load('submitRecords');
    }

    /**
     * 获取正确率
     * @param $userId
     * @return string
     */
    public function getCorrectRate($userId)
    {
        $submits = $this->getSubmitRelated($userId)->toArray();
        $count = count($submits['submit_records']);
        $num = 0;
        foreach ($submits['submit_records'] as $submit){
            if($submit['is_correct'] == true){
                $num++;
            }
        }
        $avg = round($num/$count*100 , 2 ).'%';

        return $avg;
    }

}