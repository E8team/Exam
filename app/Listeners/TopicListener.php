<?php

namespace App\Listeners;

use App\Events\SubmitedTopic;
use App\Models\MockRecord;
use App\Models\PracticeSubmitCount;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Auth;
use DB;

class TopicListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param $event
     * @return void
     */
    public function handle($event)
    {
        if($event instanceof SubmitedTopic){
            $event->topic->total_submit_count++;
            if($event->submitRecord->is_correct){
                $event->topic->correct_submit_count++;
            }
            $event->topic->save();
            if($event->submitRecord->isMock()){
                $mockRecord = MockRecord::find($event->submitRecord->mock_record_id);
                if($mockRecord){
                    if($event->submitRecord->is_correct)
                        $mockRecord->correct_count++;
                    $mockRecord->submit_count++;
                    $mockRecord->save();
                }
            }elseif($event->submitRecord->isPractice()){
                $data = ['submit_count' => DB::raw('`submit_count` + 1')];
                if($event->submitRecord->is_correct)
                    $data['correct_count'] = DB::raw('`correct_count` + 1');
                PracticeSubmitCount::where('user_id',Auth::id())->where('course_id', $event->topic->course_id)->update($data);
            }
        }
    }
}
