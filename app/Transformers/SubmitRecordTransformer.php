<?php


namespace App\Transformers;
use App\Models\SubmitRecord;
use App\Services\Admin\SubmitRecordService;
use League\Fractal\TransformerAbstract;


class SubmitRecordTransformer extends TransformerAbstract
{
    public function transform(SubmitRecord $submitRecord)
    {
        return [
            'id' => $submitRecord->id,
            //'user_name' => $submitRecord->user()->pluck('name'),
            'user_name' => $submitRecord->user->name,
            'topic_id' => $submitRecord -> topic_id,
            'is_correct' => $submitRecord ->is_correct,
            'type' => $submitRecord -> type,
        ];
    }
}