<?php

namespace App\Http\Middleware;

use Closure;

class CheckNotRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$role)
    {
        $role = explode('|', $role);
        
        
        if(in_array(auth()->user()->role, $role)) {
            return redirect('/notfound');
        }
        return $next($request);
       
    }
}
