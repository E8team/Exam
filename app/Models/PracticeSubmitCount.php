<?php

namespace App\Models;

class PracticeSubmitCount extends  BaseModel
{

    protected $fillable = ['user_id', 'course_id', 'correct_count', 'submit_count'];
    public $timestamps = false;


    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

}
