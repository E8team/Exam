<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Services\TopicService;

class IndexController extends Controller
{

    public function test()
    {
        
        $topic = app(TopicService::class)->randomTopic(User::find(1), 2);
        return '123';

    }

}