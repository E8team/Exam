<?php

namespace App\Models;

class Course extends BaseModel
{
    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    /**
     * --
     * 课程下有多个学生
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

}
