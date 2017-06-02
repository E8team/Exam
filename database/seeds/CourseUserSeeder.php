<?php

use Illuminate\Database\Seeder;

class CourseUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        //for($i = 1 ; $i>=2 ; $i++){
            for($j = 51 ; $j<=100 ; $j++)
                DB::table('course_user')->insert([
                    'course_id' => 2,
                    'user_id' => $j
                ]);
        //}
    }
}
