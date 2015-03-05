<?php

use App\Group;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsData extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Group::create(array('name' => 'staff', 'title' => '幹部'));
        Group::create(array('name' => 'member', 'title' => '社員'));
        Group::create(array('name' => 'default', 'title' => '預設'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Group::where('name', '=', 'staff')->delete();
        Group::where('name', '=', 'member')->delete();
        Group::where('name', '=', 'default')->delete();
    }

}
