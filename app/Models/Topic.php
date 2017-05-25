<?php

namespace App\Models;

use Cache;
use DB;

class Topic extends BaseModel
{

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function getCorrectSubmitCountAttribute()
    {
        return $this->getSubmitCountFromCache()->correct_submit_count;
    }

    public function getTotalSubmitCountAttribute()
    {
        return $this->getSubmitCountFromCache()->total_submit_count;
    }

    private function getSubmitCountFromCache()
    {
        $id = $this->getKey();
        return Cache::remember('Topic:'.$id.':submit_count', config('cache.ttl'), function () use ($id){
            return DB::table($this->getTable())->select('correct_submit_count', 'total_submit_count')
                ->where($this->getKeyName(), $this->getKey())->first();
        });
    }


    public function test()
    {
        return $this->attributes;
    }


}
