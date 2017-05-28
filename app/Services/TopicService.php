<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Topic;
use App\Models\User;
use Cache;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Cache\TaggableStore;

class TopicService
{
    public function findTopic($topicId)
    {
        $topic = Topic::findOrFail($topicId)->load('options');
        return $topic;
    }

    public function findTopicFromCache($topicId)
    {
        return Cache::rememberForever('topic:' . $topicId, function () use ($topicId) {
            return $this->findTopic($topicId);
        });
    }

    public function findTopicsFromCache($topicIds)
    {
        $res = new Collection();
        foreach ($topicIds as $topicId) {
            $res->push($this->findTopicFromCache($topicId));
        }
        return $res;
    }

    public function getTopicIdsByCourse($course)
    {
        return Topic::byCourse($course)->orderedByTopicNum()->limit(500)->get(['id', 'topic_num']);
    }

    public function getTopicIdsByCourseFromCache($course)
    {
        return Cache::rememberForever('all_topic_ids', function () use ($course) {
            return $this->getTopicIdsByCourse($course);
        });
    }

    /**
     *  随机$topicCount个题目的id
     * @param $user
     * @param $course
     * @param int $topicCount
     * @return mixed
     */
    public function randomTopicIds(User $user, $course, $topicCount = 50)
    {
        if ($course instanceof Course) {
            $courseId = $course->id;
        } else {
            $courseId = $course;
        }
        // 优先获取没有模拟过的题目
        $submitedTopicIds = $user->submitRecords()->select('topics.id')->join('topics', 'submit_records.topic_id', '=', 'topics.id')
            ->where('topics.course_id', $courseId)
            ->mock()
            ->distinct()
            ->get()
            ->pluck('id');
        $topIds = $this->getTopicIdsByCourseFromCache($course)->pluck('id');
        // 没做过的题目
        $noSubmitTopicIds = $topIds->diff($submitedTopicIds);
        if ($noSubmitTopicIds->count() >= $topicCount) {
            $randomTopicIds = $noSubmitTopicIds->random($topicCount);
        } else {
            $randomTopicIds = $submitedTopicIds->random($topicCount - $noSubmitTopicIds->count())->merge($noSubmitTopicIds);
        }
        return $randomTopicIds;
    }

    public function allTopicNumWithLastSubmitRecord($course, $user)
    {
        $topicIds = $this->getTopicIdsByCourseFromCache($course);

        $topicIds->load(['submitRecord' => function ($query) use ($user) {
            if ($user instanceof User) {
                $userId = $user->id;
            } else {
                $userId = $user;
            }
            return $query->where('submit_records.user_id', $userId)->recent()->limit(1);

        }]);
        return $topicIds;
    }

    public function getPaginator($topicIds, $perPage, $pageName = 'page', $page = null)
    {
        $page = $page ?: AbstractPaginator::resolveCurrentPage($pageName);
        if ($topicIds instanceof Collection) {
            return new LengthAwarePaginator($this->findTopicsFromCache($topicIds->forPage($page, $perPage)), $topicIds->count(), $perPage);
        } else {
            // array
            $topicIdsForPage = array_slice($topicIds, ($page - 1) * $perPage, $perPage, true);
            return new LengthAwarePaginator($this->findTopicsFromCache($topicIdsForPage), count($topicIds), $perPage);
        }
    }
}
