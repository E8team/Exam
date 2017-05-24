<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
}
