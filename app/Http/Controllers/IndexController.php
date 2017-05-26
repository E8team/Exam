<?php

namespace App\Http\Controllers;


use App\Models\Topic;
use App\Services\TopicService;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function test(Request $request)
    {
        dd(app(TopicService::class)->findTopicsFromCache(app(TopicService::class)->randomTopicIds(\App\Models\User::find(1),1)));
    }

}