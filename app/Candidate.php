<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Candidate extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'candidates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['number', 'job', 'name', 'department', 'class', 'type'];

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

    public function voteCount($booth = null)
    {
        if (empty($booth)) {
            //全部的票
            $count = $this->votes()->sum('count');
        } else {
            //特定投票所的票
            $count = $this->votes()->where('booth_id', '=', $booth)->sum('count');
        }
        return $count;
    }

    public function canVote()
    {
        $candidate_id = DB::table('candidates')->where('number', '=', $this->number)
            ->where('type', '=', $this->type)
            ->select(DB::raw('min(id) as id'))
            ->groupBy('number')
            ->get();
        if ($candidate_id[0]->id == $this->id) {
            return true;
        }
        return false;
    }
}
