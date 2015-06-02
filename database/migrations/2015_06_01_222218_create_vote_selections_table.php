<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoteSelectionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vote_selections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vote_event_id')->unsigned();
            $table->integer('card_id')->unsigned()->nullable();
            $table->string('alt_text', 100);
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
        Schema::drop('vote_selections');
    }

}
