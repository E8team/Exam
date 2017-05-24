<?php

namespace App\Http\Controllers;


use App\Services\DepartmentClassService;

class IndexController extends Controller
{

    public function test()
    {

        echo DepartmentClassService::getDepartmentClassFromCache(17);
    }

}