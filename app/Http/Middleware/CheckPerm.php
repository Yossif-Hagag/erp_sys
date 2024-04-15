<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPerm
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $x): Response
    {
        if (\Auth::guard('admin')->check()) {
            return $next($request);
        }else{
            if (checkPerm($x)) {
                return $next($request);
            }else{
                abort(401);
            }
        }

    }
}
