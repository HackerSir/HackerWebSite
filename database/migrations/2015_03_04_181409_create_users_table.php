<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function ($table) {
            $table->increments('id');
            $table->string('nid', 8);
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('name', 20);
            $table->string('grade', 20);
            $table->integer('group_id');
            $table->rememberToken();
            $table->string('confirm_code', 64);
            $table->timestamp('confirm_at')->nullable();
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
        Schema::drop('users');
    }

}
