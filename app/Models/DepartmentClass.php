<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartmentClass extends Model
{
    public function parent()
    {
        return $this->hasOne(DepartmentClass::class, 'id', 'parent_id');
    }

    public function __toString()
    {
        $this->parent->parent->title;
        $this->parent->title;$this->title;
        $str = '('.$this->title.')';
        if(!is_null($this->parent)){
            $str = $this->parent->title.$str;
            if(!is_null($this->parent->parent)){
                $str = $this->parent->parent->title.' '.$str;
                if(!is_null($this->parent->parent->parent)){
                    $str = $this->parent->parent->parent->title.' '.$str;
                }
            }
        }
        return $str;
    }
}
