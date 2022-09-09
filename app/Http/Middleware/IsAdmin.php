<?php

namespace App\Http\Middleware;

use Closure;
use App\Admin;
class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!auth('admin')->user()){
            return redirect('/admin/')->with('error','You have not admin access');
        }

    return $next($request);
    }
}
