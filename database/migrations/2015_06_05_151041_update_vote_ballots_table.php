<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateVoteBallotsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vote_ballots', function ($table) {
            $table->string('id', 64)->default('key')->change();
            $table->dropColumn('ballot_id');
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
            $table->integer('id')->default(0)->unsigned()->change();
            $table->string('ballot_id', 64);
        });
    }

}
