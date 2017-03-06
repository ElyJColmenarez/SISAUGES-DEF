<?php

namespace SISAUGES\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SuperUserMiddleware
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
        if(Auth::user()->id_rol == 1)
        {
            return redirect('Usuario/Listar');
        }
        return $next($request);
    }
}
