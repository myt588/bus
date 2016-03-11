<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
        if (\Auth::user()->hasRole("admin")) {
            return $next($request);
        } else {
            \Auth::logout();
            return redirect("/login")->withErrors("You are not authorized for this action");
        }
    }
}
