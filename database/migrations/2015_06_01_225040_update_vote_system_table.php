<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateVoteSystemTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vote_ballots', function ($table) {
            $table->foreign('vote_event_id')->references('id')->on('vote_events')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('vote_selection_id')->references('id')->on('vote_selections')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('vote_events', function ($table) {
            $table->foreign('creator')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('watcher')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('vote_selections', function ($table) {
            $table->foreign('vote_event_id')->references('id')->on('vote_events')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('card_id')->references('id')->on('cards')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('vote_users', function ($table) {
            $table->foreign('card_id')->references('id')->on('cards')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('vote_event_id')->references('id')->on('vote_events')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vote_ballots', function ($table) {
            $table->dropForeign('vote_ballots_vote_event_id_foreign');
            $table->dropForeign('vote_ballots_vote_selection_id_foreign');
        });
        Schema::table('vote_events', function ($table) {
            $table->dropForeign('vote_events_creator_foreign');
            $table->dropForeign('vote_events_watcher_foreign');
        });
        Schema::table('vote_selections', function ($table) {
            $table->dropForeign('vote_selections_vote_event_id_foreign');
            $table->dropForeign('vote_selections_card_id_foreign');
        });
        Schema::table('vote_users', function ($table) {
            $table->dropForeign('vote_users_card_id_foreign');
            $table->dropForeign('vote_users_vote_event_id_foreign');
        });
    }

}
