<?php

namespace App\Models;

use App\Models\Traits\Listable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends BaseModel implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;
    use Notifiable, Listable;
    protected static $allowSortFields = ['id', 'studnet_num'];
    protected static $allowSearchFields = ['student_num', 'name'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_num', 'id_card_num', 'name',
        'email', 'password', 'department_class_id' , 'is_selected_courses'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'verified' => 'boolean'
    ];

    public function submitRecords()
    {
        return $this->hasMany(SubmitRecord::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class , 'course_user' , 'user_id' ,'course_id');
    }
    
    /*public function courses()
    {
        return $this->belongsTo(Course::class , 'is_selected_courses');
    }*/


    /**
     * --
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function departmentClass()
    {
        return $this->belongsTo(DepartmentClass::class);
    }


    public function getMockCount()
    {
        return $this->mockRecords()->count();
    }

    public function mockRecords()
    {
        return $this->hasMany(MockRecord::class);
    }
}
