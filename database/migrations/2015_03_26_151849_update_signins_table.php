<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSigninsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('signins', function ($table) {
            $table->foreign('card_id')->references('id')->on('cards')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('signins', function ($table) {
            $table->dropForeign('signins_card_id_foreign');
            $table->dropForeign('signins_course_id_foreign');
        });
    }

}
