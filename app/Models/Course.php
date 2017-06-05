<?php

namespace App\Models;

class Course extends BaseModel
{
    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'course_user' ,  'course_id' ,'user_id');
    }

}
