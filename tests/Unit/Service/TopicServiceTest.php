<?php

namespace Tests\Unit;

use App\Models\DepartmentClass;
use App\Models\User;
use App\Services\DepartmentClassService;
use App\Services\TopicService;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TopicServiceTest extends TestCase
{
    public function testRandomTopic()
    {


       dd( app(TopicService::class)->randomTopic(User::find(1), 1)->toArray());
    }

    public function testGetDepartmentClassFromCache()
    {


    }
}
