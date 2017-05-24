<?php

use Illuminate\Database\Seeder;

class DepartmentClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parentIds = [];
        $parentIds['法学院'] = DB::table('department_classes')->insertGetId([
            'title'=>'法学院',
            'short_title'=>'法学院',
            'parent_id' => 0
        ]);
        $parentIds['经济与管理学院'] = DB::table('department_classes')->insertGetId([
            'title'=>'经济与管理学院',
            'short_title'=>'经管学院',
            'parent_id' => 0
        ]);
        $parentIds['文化创意与传播学院'] = DB::table('department_classes')->insertGetId([
            'title'=>'文化创意与传播学院',
            'short_title'=>'文传学院',
            'parent_id' => 0
        ]);
        $parentIds['外国语学院'] = DB::table('department_classes')->insertGetId([
            'title'=>'外国语学院',
            'short_title'=>'外国语学院',
            'parent_id' => 0
        ]);
        $parentIds['教育学院'] = DB::table('department_classes')->insertGetId([
            'title'=>'教育学院',
            'short_title'=>'教育学院',
            'parent_id' => 0
        ]);
        $parentIds['金融学院'] = DB::table('department_classes')->insertGetId([
            'title'=>'金融学院',
            'short_title'=>'金融学院',
            'parent_id' => 0
        ]);
        $parentIds['电子工程学院'] = DB::table('department_classes')->insertGetId([
            'title'=>'电子工程学院',
            'short_title'=>'电工学院',
            'parent_id' => 0
        ]);
        $parentIds['化工与材料工程学院'] = DB::table('department_classes')->insertGetId([
            'title'=>'化工与材料工程学院',
            'short_title'=>'化工学院',
            'parent_id' => 0
        ]);
        $parentIds['生物工程学院'] = DB::table('department_classes')->insertGetId([
            'title'=>'生物工程学院',
            'short_title'=>'生物学院',
            'parent_id' => 0
        ]);
        $parentIds['计算机学院'] = DB::table('department_classes')->insertGetId([
            'title'=>'计算机学院',
            'short_title'=>'计算机学院',
            'parent_id' => 0
        ]);
        $parentIds['美术与设计学院'] = DB::table('department_classes')->insertGetId([
            'title'=>'美术与设计学院',
            'short_title'=>'美院',
            'parent_id' => 0
        ]);
        $parentIds['体育学院'] = DB::table('department_classes')->insertGetId([
            'title'=>'体育学院',
            'short_title'=>'体院',
            'parent_id' => 0
        ]);
        $parentIds['音乐与舞蹈学院'] = DB::table('department_classes')->insertGetId([
            'title'=>'音乐与舞蹈学院',
            'short_title'=>'音乐学院',
            'parent_id' => 0
        ]);
        $parentIds['机械与电气工程学院'] = DB::table('department_classes')->insertGetId([
            'title'=>'机械与电气工程学院',
            'short_title'=>'机电学院',
            'parent_id' => 0
        ]);
    }
}
