<?php


namespace App\Transformers;


use App\Models\Course;

class CourseTransformer
{
    public function transform(Course $course)
    {

        return [
            'id' => $course->id,
            'name' => $course->name
        ];
    }
}