<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use \Conner\Tagging\TaggableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'courses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['time', 'subject', 'lecturer'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function signins()
    {
        return $this->hasMany('App\Signin');
    }

    public function check($user)
    {
        if (!($user instanceof User)) {
            return false;
        }
        foreach ($this->signins as $signin) {
            if ($signin->card->user()->nid == $user->nid) {
                return true;
            }
        }
        return false;
    }
}
