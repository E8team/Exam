<?php

namespace App\Transformers;


use App\Models\Student;
use League\Fractal\TransformerAbstract;

class StudentTransformer extends TransformerAbstract
{

    public function transform(Student $student)
    {

        return [
            'id' => $student->id,
            'student_num' => $student->student_num,
            'name' => $student->name,
            'id_card_num' => $student->id_card_num,
            'department_class_id' => $student->department_class_id
        ];
    }

}
