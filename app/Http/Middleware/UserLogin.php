<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has("user"))
            return redirect("/login")->with("error", "Belum Login!");
        return $next($request);
    }
}
