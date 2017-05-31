<?php

namespace App\Models;



class MockRecord extends BaseModel
{
    protected $fillable = ['user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function submitRecord(){
        return $this->hasMany(SubmitRecord::class);
    }
}
