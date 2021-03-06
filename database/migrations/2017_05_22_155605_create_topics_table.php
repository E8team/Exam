<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('topic_num')->index()->comment('题号');
            $table->unsignedInteger('course_id')->index();
            $table->string('title');
            // $table->unsignedInteger('correct_option_id')->default(0);
            $table->unsignedInteger('correct_submit_count')->comment('提交正确的数量');
            $table->unsignedInteger('total_submit_count')->comment('提交总量');
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
        Schema::dropIfExists('topics');
    }
}
