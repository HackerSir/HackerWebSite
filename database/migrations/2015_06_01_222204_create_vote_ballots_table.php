<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoteBallotsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vote_ballots', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ballot_id', 64);
            $table->integer('vote_event_id')->unsigned();
            $table->integer('vote_selection_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('vote_ballots');
    }

}
