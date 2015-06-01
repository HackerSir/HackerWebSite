<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class VoteBallot extends Model
{

    protected $table = 'vote_ballots';
    protected $fillable = ['ballot_id', 'vote_event_id', 'vote_selection_id'];

    public function voteEvent()
    {
        return $this->belongsTo('App\VoteEvent');
    }

    public function voteSelection()
    {
        return $this->belongsTo('App\VoteSelection');
    }
}
