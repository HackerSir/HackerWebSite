<?php namespace App;

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

}
