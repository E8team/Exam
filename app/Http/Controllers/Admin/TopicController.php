<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2017/5/28
 * Time: 13:41
 */

namespace App\Http\Controllers\Admin;


use App\Services\TopicService;

class TopicController
{

    public function getTopicIdsByCourse()
    {
        dd(app(TopicService::class)->findTopicsNumFromCache(100)->toArray());
    }


}