<?php

namespace App\Http\Controllers;


use App\Models\Topic;
use App\Models\User;
use App\Services\MockService;
use App\Services\TopicService;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function test(Request $request)
    {
        dd(app(MockService::class)->getCorrectTopicCount(User::find(1)));
        //dd(app(TopicService::class)->findTopicsFromCache(app(TopicService::class)->randomTopicIds(\App\Models\User::find(1),1)));
    }

}
