<?php
namespace App\Services;

use App\Models\DepartmentClass;
use Cache;

class DepartmentClassService
{
    public static function getDepartmentClass($id)
    {
        return DepartmentClass::findOrFail($id)->load('parent.parent.parent');
    }
    public static function getDepartmentClassFromCache($id)
    {
        return Cache::rememberForever('department_class:'.$id, function () use ($id){
            return self::getDepartmentClass($id);
        });
    }
}