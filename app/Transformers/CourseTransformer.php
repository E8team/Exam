<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2017/5/31
 * Time: 20:52
 */

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