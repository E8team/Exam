<?php
namespace App\Services;

use App\Models\DepartmentClass;
use App\Models\Topic;
use Cache;

class TopicService
{
    public function getTopic($topicId)
    {
        $topic = Topic::findOrFail($topicId)->load('options');
        return $topic;
    }
    public function getTopicFromCache($topicId)
    {
        return Cache::rememberForever('topic:'.$topicId, function () use ($topicId){
            return $this->getTopic($topicId);
        });
    }
}