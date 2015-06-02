<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class VoteSelection extends Model
{

    protected $table = 'vote_selections';
    protected $fillable = ['vote_event_id', 'card_id', 'alt_text'];

    public function voteBallots()
    {
        return $this->hasMany('App\VoteBallot');
    }

    public function voteEvent()
    {
        return $this->belongsTo('App\VoteEvent');
    }

    public function card()
    {
        return $this->belongsTo('App\Card');
    }

    public function getText()
    {
        if ($this->card) {
            return $this->card->getName();
        } else {
            return $this->alt_text;
        }
    }

}
