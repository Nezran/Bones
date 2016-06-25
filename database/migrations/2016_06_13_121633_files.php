<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Files extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->string('name', 45);
            $table->longText('description');
            $table->longText('url');
            $table->string('mime', 45);
            $table->string('size', 45);
            $table->integer('project_id')->unsigned();
            $table->timestamps(); // Creation the column "created_at" and "updated_at"
        });

        Schema::table('files', function($table) {
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
        Schema::drop('files');
    }
}
