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
        $mockRecords->completed_topic_count= $mockRecords->submitRecords->count();
       return $mockRecords;
    }

    /**
     * 判断用户最后一次模拟做题是否完成
     * @return mixed
     */
    public function getNotEndedMockRecord(User $user)
    {
        return MockRecord::where(['user_id'=>$user->id])->whereNull('ended_at')->recent()->firstOrFail();
    }

    /**
     * 交卷
     * @param User $user
     * @return int
     */
    public function getCorrectTopicCount(User $user)
    {
        //
    }

    public function getSubmitRecords($mockRecord, $user){
        return $mockRecord->submitRecords()->where('submit_records.user_id', $user->id)->get();
    }
}
