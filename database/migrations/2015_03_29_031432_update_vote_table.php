<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateVoteTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('votes', function ($table) {
            $table->foreign('candidate_id')->references('id')->on('candidates')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('booth_id')->references('id')->on('booths')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('votes', function ($table) {
            $table->dropForeign('votes_candidate_id_foreign');
            $table->dropForeign('votes_booth_id_foreign');
        });
    }

}
