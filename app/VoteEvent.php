<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class VoteEvent extends Model
{

    protected $table = 'vote_events';
    protected $fillable = ['open_time', 'close_time', 'location', 'subject', 'info', 'creator', 'watcher'];

    public function creator()
    {
        return $this->belongsTo('App\User', 'creator');
    }

    public function watcher()
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
