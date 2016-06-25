<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Targets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('targets', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->integer('project_id')->unsigned();
            $table->longText('description');
            $table->string('status', 45);
            $table->timestamps(); // Creation the column "created_at" and "updated_at"
        });

        Schema::table('targets', function ($table) {
            $table->foreign('project_id')->references('id')->on('projects');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('targets');
    }
}