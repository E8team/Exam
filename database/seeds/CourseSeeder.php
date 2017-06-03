<?php

use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert(
            [
                [
                    'id' => 1,
                    'name' => '马克思主义基本原理概论',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'id' => 2,
                    'name' => '中国近代史纲要',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
            ]
        );

        /*for($i = 0; $i<50 ; $i++){
            //$course_id = random_int(1,2);
            $str = join('',range('a', 'z'));
            $title =  ucfirst(substr(str_shuffle($str),0,15));
            $answer = array_rand(array('A','B','C','D'));
            $date = date();
            DB::table('topics')->insert([
                'course_id'=>$course_id,
                'title'=>$title,
                'answer'=>$answer,
                'correct_submit_count'=>0,
                'total_submit_count'=>0,
                'created_at'=>$date
            ]);
        }*/
    }
}
