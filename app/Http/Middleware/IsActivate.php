<?php

namespace Parking\Http\Middleware;

use Closure;

class IsActivate
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
        if ( auth()->user()->activate )
            return $next($request);

        flash('Your account has been deactivated. Please logout.')->error();

        return redirect()->route('welcome');
    }
}
