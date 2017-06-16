<?php

namespace SISAUGES\Http\Middleware;

use Closure;

class VisitanteMiddleware
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
        elseif(Auth::user()->id_rol != 4)
        {
            return redirect('');
        }
        else
        {
            return $next($request);
        }
    }
}
