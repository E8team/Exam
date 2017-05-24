<?php

namespace App\Http\Controllers;



use App\Services\DepartmentClassService;

class IndexController extends Controller
{

    public function test()
    {
        dd(app(DepartmentClassService::class)->allDepartments()->toArray());
    }

}