<?php

namespace App\Models;


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
}
