<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function getCount()
    {
        $selfCount = VoteBallot::where('vote_event_id', '=', $this->vote_event_id)
            ->where('vote_selection_id', '=', $this->id)
            ->count();
        return $selfCount;
    }

    public function isMax()
    {
        //各選項得票數
        $count = VoteBallot::select(DB::raw('vote_selection_id, count(*) as selection_count'))
            ->where('vote_event_id', '=', $this->vote_event_id)
            ->groupBy('vote_selection_id')
            ->get();
        //最高得票數
        $max = $count->max('selection_count');
        //本身得票數
        $selfCount = $this->getCount();
        //判斷
        return $selfCount == $max;
    }

}
