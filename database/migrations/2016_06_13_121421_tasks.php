<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->string('name', 45);
            $table->integer('duration');
            $table->date('date_jalon');
            $table->string('status', 15);
            $table->integer('priority');
            $table->integer('project_id')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable(true);
            $table->timestamps(); // Creation the column "created_at" and "updated_at"
        });

        Schema::table('tasks', function($table) {
            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('parent_id')->references('id')->on('tasks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tasks');
    }
}
