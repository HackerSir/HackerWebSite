<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class VoteBallot extends Model
{

    protected $table = 'vote_ballots';
    protected $fillable = ['ballot_id', 'vote_event_id', 'vote_selection_id'];

}
