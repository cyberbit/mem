<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // User is not authenticated, or API token is invalid
        if ($this->auth->guard($guard)->guest()) {
            // API request
            if ($request->is('api/*')) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            
            // Non-API request (token provided)
            elseif ($request->has('api_token')) {
                return redirect()->route('login', ['error' => 1]);
            }
            
            // Non-API request (no token provided)
            else {
                return redirect('login');
            }
        }

        return $next($request);
    }
}
