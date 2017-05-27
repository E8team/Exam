<?php

namespace App\Models;

class Course extends BaseModel
{
    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

}
