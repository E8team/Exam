<?php

namespace App\Models;


class SubmitRecord extends BaseModel
{
    protected $table = 'submit_records';
    protected $fillable = ['topic_id', 'selected_option_id', 'type', 'mock_record_id', 'user_id', 'is_correct'];
    protected $casts = [
        'is_correct' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePractice($query)
    {
        return $query->where('type', 'practice');
    }

    public function scopeMock($query)
    {
        return $query->where($this->getTable().'.type', 'mock');
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
}
