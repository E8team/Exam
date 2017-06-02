<?php


namespace App\Http\Controllers\Admin\Api;


use App\Models\SubmitRecord;
use App\Services\Admin\SubmitRecordService;
use App\Transformers\SubmitRecordTransformer;

class SubmitRecordController extends ApiController
{

    public function lists(SubmitRecordService $submitRecord)
    {
        $submits = SubmitRecord::withSort()->withSimpleSearch()->paginate($this->perPage(50));
        return $this->response->paginator($submits, new SubmitRecordTransformer())
            ->setMeta(SubmitRecord::getAllowSortFieldsMeta() + SubmitRecord::getAllowSearchFieldsMeta());
    }

    public function getSubmitRecord(SubmitRecordService $submitRecord , $submitId)
    {
        dd($submitRecord -> getSubmitRecord($submitId)->toArray());
    }
}