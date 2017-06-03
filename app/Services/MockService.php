<?php
namespace App\Services;

use App\Models\MockRecord;
use App\Models\MockTopic;
use App\Models\User;

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

    public function allMockRecordByUser($user)
    {
        if($user instanceof User){
            $userId = $user->id;
        }else{
            $userId = $user;
        }
        return MockRecord::where(['user_id'=>$userId])->get();
    }

    public function getSubmitRecords($mockRecord, $user){
        return $mockRecord->submitRecords()->where('submit_records.user_id', $user->id)->get();
    }
}
