<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Signin extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'signins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['time', 'card_id', 'course_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function card()
    {
        return $this->belongsTo('App\Card');
    }

    public function course()
    {
        return $this->belongsTo('App\Course');
    }
}
