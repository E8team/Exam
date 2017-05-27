<?php

namespace App\Http\Controllers;



use App\Models\Topic;
use App\Services\TopicService;

class IndexController extends Controller
{

    public function test()
    {
        $topic = app(TopicService::class)->findTopicFromCache(1);

        dd($topic->toArray());

    }

}
