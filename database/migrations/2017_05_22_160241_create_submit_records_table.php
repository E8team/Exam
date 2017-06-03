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
            // todo user_id topic_id 组合索引
            $table->unsignedInteger('user_id')->index();
            $table->unsignedInteger('topic_id')->index();
            $table->unsignedInteger('selected_option_id')->comment('用户提交时所选的option id');
            $table->boolean('is_correct')->comment('用户提交的答案是否是正确的');
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
        Schema::dropIfExists('submit_records');
    }
}
