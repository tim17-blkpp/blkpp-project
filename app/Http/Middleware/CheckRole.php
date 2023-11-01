<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $roles = array_slice(func_get_args(), 2);

        if (auth()->user() != null) {
            // if (auth()->user()->role == 'super_admin' || auth()->user()->role == 'pengelola') {
            //     return $next($request);
            // }

            foreach ($roles as $role) {
                $userRole = auth()->user()->role;
                if ($userRole == $role) {
                    return $next($request);
                }
            }
        } else {
            return redirect('/')->with('error', "You don't login.");
        }

        return redirect('/')->with('error', "You don't have admin access.");
    }
}
