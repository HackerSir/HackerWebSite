<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cards';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['time', 'nid', 'card_number', 'grade', 'name'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function signins()
    {
        return $this->hasMany('App\Signin')->orderBy('time', 'asc');
    }

    public function user()
    {
        $user = User::where('nid', '=', $this->nid)->first();
        if ($user) {
            return $user;
        }
        return null;
    }

    public function getName()
    {
        if ($this->user() != null) {
            return $this->user()->name;
        }
        return $this->name;
    }

    public function getGrade()
    {
        if ($this->user() != null) {
            return $this->user()->grade;
        }
        return $this->grade;
    }
}
