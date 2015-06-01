<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class VoteUser extends Model
{

    protected $table = 'vote_users';
    protected $fillable = ['card_id', 'vote_event_id', 'check_in_time', 'voted'];

}
