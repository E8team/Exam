<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->char('student_num', 10)->unique()->comment('学号');
            $table->string('name')->comment('学生姓名');
            $table->char('id_card_num', 18)->unqiue()->comment('身份证号码');
            $table->unsignedInteger('department_class_id')->index();
            $table->string('email')->unique();
            $table->char('tel', 11)->unqiue()->default('')->comment('手机号码');
            $table->string('password');
            $table->boolean('is_selected_courses')->default(false);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
