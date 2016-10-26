<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('summary');
            $table->integer('category');//1:software,2:hardware

            $table->integer('state_id')->unsigned();
            $table->foreign('state_id')->references('id')->on('states');

            $table->string('date');

            $table->integer('frequency_id')->unsigned();
            $table->foreign('frequency_id')->references('id')->on('frequencies');

            $table->integer('priority_id')->unsigned();
            $table->foreign('priority_id')->references('id')->on('priorities');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('file');

            $table->integer('visibility')->unsigned()->default(1);//1:Público,2:Privado

            $table->string('platform');
            $table->string('os');
            $table->string('os_version');
            $table->integer('low')->default(0);//0:Not,1:Yes

            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects');

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
        Schema::drop('incidents');
    }
}
