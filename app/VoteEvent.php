<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class VoteEvent extends Model
{

    protected $table = 'vote_events';
    protected $fillable = ['open_time', 'close_time', 'location', 'subject', 'info', 'creator', 'watcher'];

}
