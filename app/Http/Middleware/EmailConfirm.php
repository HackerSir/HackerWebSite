<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class EmailConfirm
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
            //未登入
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->route('member.login');
            }
        } else if (empty($this->auth->user()->confirm_at)) {
            //未驗證
            return redirect()->route('member.resend')
                ->with('warning', '完成信箱驗證方可進入此頁面');
        }

        return $next($request);
    }

}
