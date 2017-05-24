<?php

namespace Tests\Unit;

use App\Models\DepartmentClass;
use App\Services\DepartmentClassService;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DepartmentClassTest extends TestCase
{
    public function testParent()
    {
        $this->assertTrue(DepartmentClass::find(17)->parent->id == 16);
    }

    public function testGetDepartmentClassFromCache()
    {
        $departmentClass = DepartmentClassService::getDepartmentClassFromCache(17);
        $this->assertTrue($departmentClass->parent->parent instanceof DepartmentClass);

    }
}
