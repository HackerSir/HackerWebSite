<?php

use App\Group;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoteGroupAndAccount extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $group = Group::create(array('name' => 'vote', 'title' => '投票專用'));
        $user = User::create(array(
            'name' => '投票帳號',
            'nickname' => '投票帳號',
            'register_at' => Carbon::now()->toDateTimeString(),
            'confirm_at' => Carbon::now()->toDateTimeString()
        ));
        $user = $group->users()->save($user);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $group = Group::where('name', '=', 'vote')->first();
        User::where('group_id', '=', $group->id)->delete();
        $group->delete();
    }

}
