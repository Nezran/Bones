<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Invitations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->longtext('token');
            $table->string('status', 45);
            $table->integer('guest_id')->unsigned();
            $table->integer('host_id')->unsigned();
            $table->integer('project_id')->unsigned();
            $table->timestamps(); // Creation the column "created_at" and "updated_at"
        });

        Schema::table('invitations', function($table) {
            $table->foreign('guest_id')->references('id')->on('users');
            $table->foreign('host_id')->references('id')->on('users');
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
        Schema::drop('invitations');
    }
}
