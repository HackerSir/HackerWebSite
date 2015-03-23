<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Contracts\Foundation\Application;

/**
 * Secure
 * Redirects any non-secure requests to their secure counterparts.
 *
 * @param request The request object.
 * @param $next The next closure.
 * @return redirects to the secure counterpart of the requested uri.
 */
class Secure implements Middleware
{
    protected $app;

    /**
     * Routes we want to exclude.
     *
     * @var array
     */
    protected $routes = [
        '/',
    ];

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function handle($request, Closure $next)
    {
        if ($this->app->environment() === 'production') {
            if (!$this->excludedRoutes($request)) {
                //強制https
                if (!$request->secure()) {
                    return redirect()->secure($request->getRequestUri());
                }
            } else {
                //強制http
                if ($request->secure()) {
                    return redirect()->to($request->getRequestUri(), 302, array(), false);
                }
            }
        }
        return $next($request);
    }

    /**
     * This will return a bool value based on route checking.
     * @param  Request $request
     * @return boolean
     */
    protected function excludedRoutes($request)
    {
        foreach ($this->routes as $route)
            if ($request->is($route))
                return true;

        return false;
    }
}
