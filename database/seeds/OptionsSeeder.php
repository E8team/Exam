<?php

use Illuminate\Database\Seeder;

class OptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('topics')->orderBy('id')->chunk(100, function ($topics){
            foreach ($topics as $topic){
                for($i=0;$i<4;$i++){
                    $str = join('',range('a', 'z'));
                    $str = str_repeat($str,10);
                    $title =  ucfirst(substr(str_shuffle($str),0, random_int(30, 130)));
                    $answerMap = ['A', 'B', 'C', 'D'];
                    DB::table('options')->insert([
                        'topic_id'=>$topic->id,
                        'title'=>$title,
                        'option_id' => $answerMap[$i]
                    ]);
                }
            }
        });

    }
}
