<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMockRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mock_records', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index();
            $table->unsignedInteger('score')->comment('模拟分数');
            $table->unsignedSmallInteger('submit_count')->comment('答题个数');
            $table->unsignedSmallInteger('correct_count')->comment('答对的数量');
            $table->unsignedSmallInteger('wrong_count')->comment("答错的数量");
            $table->timestamps();
            $table->timestamp('ended_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mock_records');
    }
}
