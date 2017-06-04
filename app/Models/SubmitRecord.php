<?php

namespace App\Models;


use App\Models\Traits\Listable;

class SubmitRecord extends BaseModel
{
    use Listable;
    protected $table = 'submit_records';

    protected static $allowSearchFields = ['id' , 'user_name' , 'topic_id'];
    protected static $allowSortFields = ['id' , 'user_name' , 'topic_id' , 'is_correct' , 'type'];

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
        return $query->where($this->getTable().'.type', 'practice');
    }

    public function scopeMock($query)
    {
        return $query->where($this->getTable().'.type', 'mock');
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
    public function scopeByUser($query, $user)
    {
        if($user instanceof User){
            $userId = $user->id;
        }else{
            $userId = $user;
        }
        return $query->where($this->getTable().'.user_id',$userId);
    }
}
