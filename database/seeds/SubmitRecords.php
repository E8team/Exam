<?php

use Illuminate\Database\Seeder;
use App\Services\TopicService;

class SubmitRecords extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('submit_records')->truncate();
        $this->mock();
        $j = 1;
        for($i = 1 ; $i<=1000000 ; $i++){
            $userId = random_int(1,100);
            $topicId = random_int(1,500);
            $topic = app(TopicService::class)->findTopic($topicId);
            $selOptionId = random_int(0,3);
            if($topic['options'][$selOptionId]['is_correct'] == 1){
                $isCorrect = 1;
            }else{
                $isCorrect = 0;
            }
            //$type = array('practice' , 'mock');
            //$randType = rand(0,1);
            DB::table('submit_records')->insert([
                'user_id' => $userId,
                'topic_id' => $topicId,
                'selected_option_id' => $selOptionId,
                'is_correct' => $isCorrect,
                'type' => 'mock',
                'mock_record_id' => $j,
                'created_at' => \Carbon\Carbon::now()
            ]);
            if($i % 50 ==0) $j++;
        }
    }

    private function mock(){
        DB::table('mock_records')->truncate();
        for ($i=1; $i<=20000; $i++)
        {
            $userId = random_int(1,2);
            DB::table('mock_records')->insert([
                'user_id' => $userId,
                'score' =>rand(1,50)*2,
                'submit_count' =>50,
                'correct_count' =>rand(1,50),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'ended_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}
