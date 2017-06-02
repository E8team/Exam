<?php


namespace App\Http\Controllers\Admin\Api;


use App\Models\Topic;
use App\Services\TopicService;
use App\Transformers\TopicTransformer;

class TopicController extends ApiController
{
    /**
     * 返回题目列表
     * @return \Dingo\Api\Http\Response
     */
    public function lists()
    {
        $topics = Topic::withSort()->withSimpleSearch()->paginate($this->perPage());
        return $this->response->paginator($topics , new TopicTransformer())
            ->setMeta(Topic::getAllowSortFieldsMeta() + Topic::getAllowSearchFieldsMeta());
    }

    /**
     * 查询$topicId下答案
     * @param TopicService $topicService
     * @return \Dingo\Api\Http\Response
     */
    public function getTopic(TopicService $topicService , $topicId)
    {
        //$topicId = 2;
        $option = $topicService->findTopic($topicId);
        return $this->response->item($option, new TopicTransformer())
            ->addMeta('options', $option['options']);
    }
}