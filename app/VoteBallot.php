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

    public function generateHash($nid)
    {
        $salt = str_random(8);
        $timestamp = $this->created_at;
        $hash = sha1($salt . $nid . $timestamp);
        $this->ballot_id = $salt . $hash;
    }

    /*
     * @deprecated
     */
    public function verity($nid)
    {
        $salt = substr($this->ballot_id, 0, 8);
        $timestamp = $this->created_at;
        $hash = sha1($salt . $nid . $timestamp);
        return $this->ballot_id == $hash;
    }
}
