<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2017/5/28
 * Time: 20:09
 */

namespace App\Http\Controllers\Admin\Api;


use App\Models\Topic;
use App\Transformers\TopicTransformer;

class TopicController extends ApiController
{
    public function lists()
    {
        $topics = Topic::withSort()->withSimpleSearch()->paginate($this->perPage());
        return $this->response->paginator($topics , new TopicTransformer())
            ->setMeta(Topic::getAllowSortFieldsMeta() + Topic::getAllowSearchFieldsMeta());
    }
}