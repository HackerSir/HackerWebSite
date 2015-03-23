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
        if (!$request->secure() && $this->app->environment() === 'production' && !$this->excludedRoutes($request)) {
            return redirect()->secure($request->getRequestUri());
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
