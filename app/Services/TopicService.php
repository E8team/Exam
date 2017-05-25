<?php
namespace App\Services;

use App\Models\Course;
use App\Models\DepartmentClass;
use App\Models\SubmitRecord;
use App\Models\Topic;
use Cache;

class TopicService
{
    public function findTopic($topicId)
    {
        $topic = Topic::findOrFail($topicId)->load('options');
        return $topic;
    }

    public function findTopicFromCache($topicId)
    {
        return Cache::rememberForever('topic:'.$topicId, function () use ($topicId){
            return $this->findTopic($topicId);
        });
    }

    /**
     *  随机$topicCount个题目
     * @param $user
     * @param $course
     * @param int $topicCount
     * @return mixed
     */
    public function randomTopic($user, $course, $topicCount = 50)
    {
        if($course instanceof Course){
            $courseId = $course->id;
        }else{
            $courseId = $course;
        }
        // 优先获取没有模拟过的题目
        $submitedTopicIds = $user->submitRecords()->select('topics.id')->join('topics', 'submit_records.topic_id', '=', 'topics.id')
            ->where('topics.course_id', $courseId)
            ->mock()
            ->distinct()
            ->get()
            ->pluck('id');
        $topIds = Topic::byCourse($course)->select('id')->limit(500)->get()->pluck('id');
        // 没做过的题目
        $noSubmitTopicIds = $topIds->diff($submitedTopicIds);
        if($noSubmitTopicIds->count() >= $topicCount){
            $randomTopicIds = $noSubmitTopicIds->random($topicCount);
        }else{
            $randomTopicIds = $submitedTopicIds->random($topicCount-$noSubmitTopicIds->count())->merge($noSubmitTopicIds);
        }
        return Topic::findOrFail($randomTopicIds);
    }
}