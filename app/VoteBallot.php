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

    /**
     * 產生驗證用的唯一hash值
     * @param $nid
     */
    public function generateHash($nid)
    {
        $salt = str_random(8);
        $timestamp = $this->created_at;
        $hash = sha1($salt . $nid . $timestamp);
        $this->ballot_id = $salt . $hash;
    }

    /**
     * 可驗證是否為特定NID投的票
     * @deprecated 違反原則，非必要時請勿使用
     * @param $nid
     * @return bool
     */
    public function verity($nid)
    {
        $salt = substr($this->ballot_id, 0, 8);
        $timestamp = $this->created_at;
        $hash = sha1($salt . $nid . $timestamp);
        return $this->ballot_id == $hash;
    }
}
