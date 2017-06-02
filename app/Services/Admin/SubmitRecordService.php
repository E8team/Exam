<?php


namespace App\Services\Admin;

use App\Models\SubmitRecord;

class SubmitRecordService
{

    public function getAllSubmitRecords()
    {
        return SubmitRecord::all()->load('user');
    }

    public function getSubmitUsers()
    {
        $users = SubmitRecord::all()->load('user')->pluck('user.name');
        return $users;
    }

    public function getSubmitRecord($submitId)
    {
        return SubmitRecord::findOrFail($submitId)->load('user');
    }
}