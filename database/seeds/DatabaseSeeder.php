<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CourseSeeder::class);
        $this->call(TopicSeeder::class);
        $this->call(OptionsSeeder::class);
        //$this->call(SubmitRecords::class);
        //$this->call(UserSeeder::class);

    }
}
