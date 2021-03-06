<?php

namespace SISAUGES\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuditoriaMiddleware
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

        if(empty(Auth::user()))
        {
            return redirect('/login');
        }
        elseif(Auth::user()->id_rol != 1)
        {
            return redirect('');
        }
        else
        {
            return $next($request);
        }

    }
}
