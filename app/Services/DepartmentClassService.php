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
        return Cache::rememberForever('department_class:' . $departmentClassId, function () use ($departmentClassId) {
            return $this->getDepartmentClass($departmentClassId);
        });
    }

    public function allDepartments()
    {
        return DepartmentClass::byParentId(0)->orderByKey()->get();
    }

    public function allDepartmentsFromCache()
    {
        return Cache::rememberForever('all_departments', function () {
            return $this->allDepartments();
        });
    }

    public function majors($department)
    {
        if ($department instanceof DepartmentClass) {
            $builder = $department->children();
        } elseif (is_numeric($department)) {
            $builder = DepartmentClass::byParentId($department);
        }
        return $builder->orderByKey()->get();
    }


    public function grades($major)
    {
        if ($major instanceof DepartmentClass) {
            $builder = $major->children();
        } elseif (is_numeric($major)){
            $builder = DepartmentClass::byParentId($major);
        }
        return $builder->orderByKey()->get();
    }

    public function classNums($grade)
    {
        if ($grade instanceof DepartmentClass) {
            $builder = $grade->children();
        } elseif (is_numeric($grade)){
            $builder = DepartmentClass::byParentId($grade);
        }
        return $builder->orderByKey()->get();
    }

    public function __call($name, $arguments)
    {
        if(substr($name, -9) == 'FromCache')
        {
            $method = substr($name, 0,-9);
            if(method_exists($this, $method)){
                $departmentClass = $arguments[0];
                if($departmentClass instanceof DepartmentClass){
                    $departmentClassId = $departmentClass->id;
                }elseif(is_numeric($departmentClass)){
                    $departmentClassId = $departmentClass;
                }
                return Cache::rememberForever($method.':'.$departmentClassId, function () use ($method, $departmentClass){
                    return $this->$method($departmentClass);
                });
                $this->$method;
            }
        }
    }
}