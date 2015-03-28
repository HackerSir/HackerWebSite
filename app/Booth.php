<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Booth extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'booths';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'url'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function votes()
    {
        return $this->hasMany('App\Vote');
    }

}
