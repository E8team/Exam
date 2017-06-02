<?php
/**
 * Created by PhpStorm.
 * User: Lei
 * Date: 2017/5/31
 * Time: 23:16
 */

namespace App\Services\Admin;

use App\Models\SubmitRecord;

class SubmitRecordService
{

    public function getAllSubmitRecords()
    {
        return SubmitRecord::all()->load('user');
    }

    public function getSubmitRecord($submitId)
    {
        return SubmitRecord::findOrFail($submitId)->load('user');
    }
}