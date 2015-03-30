<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Response;


class ApiToken
{


    /**
     * Create a new filter instance.
     *
     */
    public function __construct()
    {
        //
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
        //檢查Token
        if (!$this->checkToken($request->get('token'))) {
            $json = [
                "status" => 1,
                "message" => "Permission Denied (Wrong Token?)"
            ];
            return Response::json($json);
        }

        return $next($request);
    }

    /*
     * 檢查Token有效性
     */
    private function checkToken($token)
    {
        //FIXME 測試用
        if ($token == "token") {
            return true;
        }
        return false;
    }
}
