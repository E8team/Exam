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
        //$path 文件位置这个是相对文件,
        $path = 'F:\xampp\htdocs\modernHistory.php';
        $topics = include_once $path;
        for($i=0;$i<500;$i++){
            $topicTitle = $topics[$i][1];
            $topicId = DB::table('topics')->insertGetId([
                'topic_num'=>$topics[$i][0],
                //课程ID写死，填充时注意
                'course_id'=>2,
                'title' => $topicTitle,
                'correct_submit_count'=>0,
                'total_submit_count'=>0,
                'created_at'=>\Carbon\Carbon::now(),
                'updated_at'=>\Carbon\Carbon::now()
            ]);

            for($j=2; $j<=5; $j++){
                $option = $topics[$i][$j];
                DB::table('options')->insert([
                    'topic_id' => $topicId,
                    'is_correct' => ord($topics[1][6])-63 == $j,
                    'title' =>$option,
                ]);
            }
        }
    }
}