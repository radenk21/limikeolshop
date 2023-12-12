<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles)
    {
        foreach ($roles as $role) {
            $role = intval($role);
            if (Auth::user()->role_as == $role) {
                return $next($request);
            }
        }
        return redirect('/home')->with('error', 'Unauthorized');
    }
}
