<?php

use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($j=1; $j<=2; $j++)
            for($i = 0; $i<500; $i++){
                $str = join('',range('a', 'z'));
                $str = str_repeat($str,10);
                $title =  ucfirst(substr(str_shuffle($str),0, random_int(50, 190)));
                //dd(strlen($title));

                DB::table('topics')->insert([
                    'course_id'=>$j,
                    'title'=>$title,
                    //'correct_option_id'=>$answerMap[random_int(0,3)],
                    'correct_submit_count'=>0,
                    'total_submit_count'=>0,
                    'created_at'=>\Carbon\Carbon::now()
                ]);
        }

    }
}
