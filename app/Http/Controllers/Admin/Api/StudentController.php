<?php

namespace App\Http\Controllers\Admin\Api;


use App\Models\Student;
use App\Transformers\StudentTransformer;

class StudentController extends ApiController
{
    public function test()
    {
        $students = Student::paginate($this->perPage());
        return $this->response->paginator($students, new StudentTransformer());
    }
}