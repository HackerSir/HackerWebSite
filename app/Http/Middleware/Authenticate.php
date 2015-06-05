<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Authenticate
{

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->route('member.login');
            }
        }
        //投票專用帳號禁止使用投票以外的會員功能
        if ($this->auth->user()->group->name == 'vote') {
            if (!$request->is('vote*')) {
                return redirect()->route('vote-event.index');
            }
        }

        return $next($request);
    }

}
