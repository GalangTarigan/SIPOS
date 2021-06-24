<?php

namespace App\Http\Middleware;

use Closure;

class UserDefault
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
        if(auth()->user()->hasDefaultRole()){
            return $next($request);
        }
            return redirect()->back()->with('error','You have not access');
    }
}
