<?php
namespace App\Services;

use App\Models\DepartmentClass;
use App\Models\Student;
use App\Models\Topic;
use Cache;

class StudentService
{
    public function findByStudentNum($studentNum)
    {
        return Student::where('student_num', $studentNum)->firstOrFail();
    }

}