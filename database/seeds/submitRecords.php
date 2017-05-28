<?php

use Illuminate\Database\Seeder;
use App\Services\TopicService;

class submitRecords extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1 ; $i<=300 ; $i++){
            $userId = random_int(1,100);
            $topicId = random_int(1,100);
            $topic = app(TopicService::class)->findTopic($topicId);
            $selOptionId = random_int(0,3);
            if($topic['options'][$selOptionId]['is_correct'] == 1){
                $isCorrect = 1;
            }else{
                $isCorrect = 0;
            }
            $type = array('practice' , 'mock');
            $randType = rand(0,1);
            
            DB::table('submit_records')->insert([
                'user_id' => $userId,
                'topic_id' => $topicId,
                'selected_option_id' => $selOptionId,
                'is_correct' => $isCorrect,
                'type' => $type[$randType],
                //todo mock_record_id 这个字段不知道什么情况 直接给个默认值
                'mock_record_id' => 0,
                'created_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}
