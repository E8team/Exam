<?php

namespace App\Models;
use Carbon\Carbon;


/**
 * Class MockRecord
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $ended_at
 * @package App\Models
 */
class MockRecord extends BaseModel
{

    protected $fillable = ['user_id'];

    protected $dates = ['created_at', 'updated_at', 'ended_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function submitRecord()
    {
        return $this->hasMany(SubmitRecord::class);
    }

    /**
     *
     *
     * if($tgus){
     *      if($this->idEnded())
     *      {
     *           creaed_at+50
     *      }else{
     *          $this->>ended_at = Canron::now();
     *      }
     * }
     * @return bool
     */

    public function isOvertime()
    {
        if($this->isEnded()) return true;
        $timeConsuming = $this->created_at->diffInSeconds(Carbon::now(), true);
        return $timeConsuming > config('exam.mock_time');
    }

    public function isEnded()
    {
        return !is_null($this->ended_at);
    }

    public function mockTopics()
    {
        return $this->hasMany(MockTopic::class);
    }
}
