<?php

namespace App\Services;

use App\Models\Course;
use App\Models\SubmitRecord;
use App\Models\Topic;
use App\Models\User;
use App\Tools\LengthAwarePaginator;
use Cache;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as BaseCollection;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Pagination\Paginator;

class TopicService
{

    public function findTopic($topicId)
    {
        $topic = Topic::findOrFail($topicId)->load('options');
        $topic->getAns();
        return $topic;
    }

    /*public function getTopicOpions($topicId)
    {
        return $this->findTopic($topicId);
    }*/

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
        return Topic::byCourse($course)->orderedByTopicNum()->limit(config('exam.practice_topics_count'))->get(['id'])->pluck('id');
    }

    public function getTopicIdsByCourseFromCache($course)
    {
        return Cache::rememberForever('all_topic_ids:course_'.$course, function () use ($course) {
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
        //todo 这条语句很慢
//        select distinct `topics`.`id` from `submit_records` inner join `topics` on `submit_records`.`topic_id` = `topics`.`id` where `submit_records`.`user_id` = '1' and `submit_records`.`user_id` is not null and `topics`.`course_id` = '1' and `submit_records`.`type` = 'mock'
        // 优先获取没有模拟过的题目
        $submitedTopicIds = $user->submitRecords()->select('topics.id')->join('topics', 'submit_records.topic_id', '=', 'topics.id')
            ->where('topics.course_id', $courseId)
            ->mock()
            ->distinct()
            ->get()
            ->pluck('id');
        $topicIds = $this->getTopicIdsByCourseFromCache($course);
        // 没做过的题目
        $noSubmitTopicIds = $topicIds->diff($submitedTopicIds);
        if ($noSubmitTopicIds->count() >= $topicCount) {
            $randomTopicIds = $noSubmitTopicIds->random($topicCount);
        } else {
            $randomTopicIds = $submitedTopicIds->random($topicCount - $noSubmitTopicIds->count())->merge($noSubmitTopicIds);
        }
        return $randomTopicIds;
    }
    //
    public function makeTopicsWithLastSubmitRecord($topics, $type, $userIdOrMockRecordId)
    {
        $builder = SubmitRecord::query();
        switch ($type)
        {
            case 'practice':
                $builder->where('user_id', $userIdOrMockRecordId)->practice();
                break;
            case 'mock':
                $builder->where('mock_record_id', $userIdOrMockRecordId)->mock();
                break;
        }

        $res = $builder->whereIn('topic_id', $topics->pluck('id'))->recent()->groupBy('submit_records.topic_id')->get();
        $relation = Topic::query()->getRelation('submitRecords');
        return new Collection( $relation->match(
            $relation->initRelation($topics->all(), 'submitRecords'),
            $res, 'submitRecords'
        ));

    }

    public function getPaginator($topicIds, $perPage, $pageName = 'page', $page = null)
    {
        $page = $page ?: AbstractPaginator::resolveCurrentPage($pageName);
        if ($topicIds instanceof BaseCollection) {
            $topicIdsForPage = $topicIds->forPage($page, $perPage);
            $topicIdsCount = $topicIds->count();

        } else {
            // array
            $topicIdsForPage = array_slice($topicIds, ($page - 1) * $perPage, $perPage, true);
            $topicIdsCount = count($topicIds);

        }
        return new LengthAwarePaginator($this->findTopicsFromCache($topicIdsForPage), $topicIdsCount, $perPage, $page,[
             'path' => Paginator::resolveCurrentPath(),
             'pageName' => $pageName,
            ]);

    }

    public function getTopicSubmit($topicId = null)
    {
        if(empty($topicId)){
            return Topic::all()->load('submitRecord');
        }else{
            return Topic::findOrFail($topicId)->load('submitRecord');
        }
    }
}
