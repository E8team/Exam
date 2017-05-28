<?php

namespace App\Http\Controllers;

use App\Services\TopicService;

class TestController
{

    public function courses()
    {
        $a = app(TopicService::class)->findTopic(20)->toArray();
        //dd($a);
        $selOptionId = random_int(0,3);
        if($a['options'][$selOptionId]['is_correct'] == 1){
            echo 'success';
        }else{
            echo 'error';
        }
    }
}
