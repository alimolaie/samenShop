<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
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
		if (Auth::guard("admin")->check()){
            return redirect('/admin/home/');
        }
		else if (Auth::guard("user")->check()) {
            return redirect('/home');
        }

		/*if (Auth::guard($guard)->check()) {
            return redirect('/home');
        }*/

        return $next($request);
    }
}
