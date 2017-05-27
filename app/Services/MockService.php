<?php
namespace App\Services;

use App\Models\MockRecord;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MockService
{
    /**
     * 获取用户最近一次模拟时的提交记录
     * @param User $user
     * @return mixed
     */
    public function getStudentMockRecord(User $user)
    {
        $mockRecords = MockRecord::where(['user_id'=> $user->id])->with(["submitRecord" => function ($query){
            $query->where('type','mock');
        }])->Recent()->first();
        $mockRecords->completed_topic_count= $mockRecords->submitRecord->count();
       return $mockRecords;
    }

    /**
     * 判断用户最后一次模拟做题是否完成
     * @return mixed
     */
    public function isMocked(User $user)
    {
        $mockrecord = MockRecord::Recent()->where(['user_id'=>$user->id])->first();
        return !is_null($mockrecord->ended_at)? true: false;
    }

    /**
     * 模拟完毕后获取正确的题目数
     * @param User $user
     * @return int
     */
    public function getCorrectTopicCount(User $user)
    {
        //
    }
}
