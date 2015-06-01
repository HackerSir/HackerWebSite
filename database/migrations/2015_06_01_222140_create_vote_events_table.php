<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoteEventsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vote_events', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('open_time')->nullable();
            $table->timestamp('close_time')->nullable();
            $table->string('location', 20);
            $table->string('subject', 100);
            $table->text('info');
            $table->integer('creator')->unsigned();
            $table->integer('watcher')->unsigned();
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
        Schema::drop('vote_events');
    }

}
