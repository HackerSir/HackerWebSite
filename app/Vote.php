<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'votes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['candidate_id', 'booths_id', 'count'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function candidate()
    {
        $this->belongsTo('App\Candidate');
    }

    public function booth()
    {
        $this->belongsTo('App\Booth');
    }

}
