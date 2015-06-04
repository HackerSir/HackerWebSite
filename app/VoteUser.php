<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class VoteUser extends Model
{

    protected $table = 'vote_users';
    protected $fillable = ['card_id', 'vote_event_id', 'check_in_time', 'voted'];

    public function card()
    {
        return $this->belongsTo('App\Card');
    }

    public function voteEvent()
    {
        return $this->belongsTo('App\VoteEvent');
    }

    public function isVoted()
    {
        return $this->voted == 1;
    }


}
