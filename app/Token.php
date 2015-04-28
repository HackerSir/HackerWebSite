<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tokens';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'token', 'deadline'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function check($token)
    {
        $token = Token::where('token', '=', $token)->where('deadline', '>=', date('Y-m-d H:i:s', time()))->first();
        if ($token) {
            return true;
        }
        return false;
    }
}
