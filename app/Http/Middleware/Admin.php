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
        if(auth()->user()->hasAdminRole()){
            // dd(auth()->user());
            return $next($request);
        }
            return redirect()->back()->with('error','You have not admin access');
        
    }
}
