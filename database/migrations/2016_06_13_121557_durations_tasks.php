<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DurationsTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('durations_tasks', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->integer('user_task_id')->unsigned();
            $table->timestamps(); // Creation the column "created_at" and "updated_at"
            $table->dateTime('ended_at');
        });

        Schema::table('durations_tasks', function($table) {
            $table->foreign('user_task_id')->references('id')->on('users_tasks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('durations_tasks');
    }
}
