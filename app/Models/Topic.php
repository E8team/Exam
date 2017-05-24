<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
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
