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
        $marxPath = public_path('marxDoctrine.php');
        $marx = include_once $marxPath;
        for($i=0;$i<500;$i++){
            $topicTitle = $marx[$i][1];
            $topicId = DB::table('topics')->insertGetId([
                'topic_num'=>$marx[$i][0],
                'course_id'=>1,
                'title' => $topicTitle,
                'correct_submit_count'=>0,
                'total_submit_count'=>0,
                'created_at'=>\Carbon\Carbon::now(),
                'updated_at'=>\Carbon\Carbon::now()
            ]);
            for($j=2; $j<=5; $j++){
                $option = $marx[0][$j];
                DB::table('options')->insert([
                    'topic_id' => $topicId,
                    'is_correct' => ord($marx[1][6])-63 == $j,
                    'title' =>$option,
                ]);
            }
        }

        $modernHistoryPath = public_path('modernHistory.php');
        $modernHistory = include_once $modernHistoryPath;
        for($i=0;$i<500;$i++){
            $topicTitle = $modernHistory[$i][1];
            $topicId = DB::table('topics')->insertGetId([
                'topic_num'=>$modernHistory[$i][0],
                'course_id'=>1,
                'title' => $topicTitle,
                'correct_submit_count'=>0,
                'total_submit_count'=>0,
                'created_at'=>\Carbon\Carbon::now(),
                'updated_at'=>\Carbon\Carbon::now()
            ]);
            for($j=2; $j<=5; $j++){
                $option = $modernHistory[0][$j];
                DB::table('options')->insert([
                    'topic_id' => $topicId,
                    'is_correct' => ord($modernHistory[1][6])-63 == $j,
                    'title' =>$option,
                ]);
            }
        }

    }
}
