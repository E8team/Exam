<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMockTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mock_topics', function (Blueprint $blueprint) {
           $blueprint->increments('id');
           $blueprint->unsignedInteger('mock_record_id')->nullable()->index();
           $blueprint->unsignedInteger('topic_id');
           $blueprint->integer('order')->default(0)->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mock_topics');
    }
}
