<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class VoteEvent extends Model
{

    protected $table = 'vote_events';
    protected $fillable = ['open_time', 'close_time', 'location', 'subject', 'info', 'creator', 'watcher'];

    public function getCreator()
    {
        return $this->belongsTo('App\User', 'creator');
    }

    public function getWatcher()
    {
        return $this->belongsTo('App\User', 'watcher');
    }

    public function voteSelections()
    {
        return $this->hasMany('App\VoteSelection');
    }

    public function voteUsers()
    {
        return $this->hasMany('App\VoteUser');
    }

    public function isStarted()
    {
        if (empty($this->open_time)) {
            return false;
        }
        $open_time = new Carbon($this->open_time);
        if (Carbon::now()->gte($open_time)) {
            return true;
        }
        return false;
    }

    public function isEnded()
    {
        if (empty($this->close_time)) {
            return false;
        }
        if (!$this->isStarted()) {
            return false;
        }
        $close_time = new Carbon($this->close_time);
        if (Carbon::now()->gte($close_time)) {
            return true;
        }
        return false;
    }

}
