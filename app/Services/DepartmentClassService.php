<?php
namespace App\Services;

use App\Models\DepartmentClass;
use Cache;

class DepartmentClassService
{
    public function getDepartmentClass($departmentClassId)
    {
        return DepartmentClass::findOrFail($departmentClassId)->load('parent.parent.parent');
    }
    public function getDepartmentClassFromCache($departmentClassId)
    {
        return Cache::rememberForever('department_class:'.$departmentClassId, function () use ($departmentClassId){
            return $this->getDepartmentClass($departmentClassId);
        });
    }
}