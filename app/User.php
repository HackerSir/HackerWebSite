<?php namespace App;

use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\DB;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'nickname', 'email', 'password', 'confirm_code', 'confirm_at', 'register_ip', 'register_at', 'lastlogin_ip', 'lastlogin_at'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    /**
     * Get either a Gravatar URL or complete image tag for a specified email address.
     *
     * @param int|string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
     * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
     * @param boole|bool $img True to return a complete IMG tag False for just the URL
     * @param array $atts Optional, additional key/value attributes to include in the IMG tag
     * @return String containing either just a URL or a complete image tag
     * @internal param string $email The email address
     */
    public function gravatar($s = 200, $d = 'mm', $r = 'g', $img = false, $atts = array())
    {
        $email = $this->email;
        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$s&d=$d&r=$r";
        if ($img) {
            $url = '<img src="' . $url . '"';
            foreach ($atts as $key => $val)
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }
        return $url;
    }

    public function isStaff()
    {
        if ($this->group->name == "staff") {
            return true;
        }
        return false;
    }

    public function isConfirmed()
    {
        if (!empty($this->confirm_at)) {
            return true;
        }
        return false;
    }

    public function card()
    {
        if (empty($this->nid)) {
            return null;
        }
        $card = Card::where('nid', '=', $this->nid)->first();
        if ($card) {
            return $card;
        }
        return null;
    }

    public function isSA()
    {
        if ($this->group->name == "sa") {
            return true;
        }
        return false;
    }

    public function tokens()
    {
        return $this->hasMany('App\Token');
    }

    public function activeTokens()
    {
        return $this->hasMany('App\Token')->where('deadline', '>=', Carbon::now()->toDateTimeString())->get();
    }
}
