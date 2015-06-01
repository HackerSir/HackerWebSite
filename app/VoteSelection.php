<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class VoteSelection extends Model
{

    protected $table = 'vote_selections';
    protected $fillable = ['vote_event_id', 'card_id', 'alt_text'];

}
