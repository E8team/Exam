<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmitRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submit_records', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index();
            $table->char('selected_answer_id', 1)->comment('用户提交时所选的答案 (A|B|C|D)');
            $table->boolean('is_right')->comment('用户提交的答案是否是正确的');
            $table->char('type', 10)->index()->comment('提交分类 (practice|mock) (练习|模拟)');
            $table->unsignedInteger('mock_record_id')->nullable()->index()->comment('模拟记录id 如果该提交记录是模拟时提交则需要该字段');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exercise_records');
    }
}
