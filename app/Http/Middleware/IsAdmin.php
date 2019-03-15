<?php

namespace Parking\Http\Middleware;

use Closure;

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
        if ( auth()->user()->isAdmin() )
            return $next($request);

        flash('Your not authorized to see this page.')->error()->important();

        return redirect('home');
    }
}
