<?php

namespace App\Transformers;


use App\Models\User;
use App\Services\Admin\UserService;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{

    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'student_num' => $user->student_num,
            'name' => $user->name,
            'id_card_num' => $user->id_card_num,
            'is_selected_courses' =>$user->	is_selected_courses,
            'mock_count' => $user->getMockCount(),
            'department_class_id' => $user->department_class_id
        ];
    }

}
