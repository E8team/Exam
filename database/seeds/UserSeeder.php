<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i<=2 ; $i++){
            for ($j = 1;$j<=50 ; $j++){
                $email = random_int(100000,900000).'@qq.com';
                $student_num =random_int(100000000,200000000);
                $departmentNum = random_int(1,15);
                $str = join('',range('a','z'));
                $stuName =  ucfirst(substr(str_shuffle($str),0, random_int(5, 10)));
                $stuTell= random_int(100000,200000).random_int(10000,20000);
                $stuPass = md5($stuName);
                $idCardNum = random_int(10000000,90000000).random_int(10000000,90000000);
                DB::table('users')->insert([
                    'student_num' => $student_num,
                    'name' => $stuName,
                    'id_card_num' => $idCardNum,
                    'department_class_id' => $departmentNum ,
                    'email' => $email,
                    'tel' => $stuTell,
                    'password' => $stuPass,
                    'is_selected_courses' => $i,
                    'created_at' => Carbon\Carbon::now()
                ]);
            }
        }
    }
}
