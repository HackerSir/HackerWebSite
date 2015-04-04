<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCardsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cards', function ($table) {
            $table->string('card_number', 20)->nullable()->change();
            $table->string('name', 20)->nullable();
            $table->string('grade', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cards', function ($table) {
            $table->string('card_number', 20)->change();
            $table->dropColumn('name');
            $table->dropColumn('grade');
        });
    }

}
