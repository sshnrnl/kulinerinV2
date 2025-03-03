<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestMiddleware
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
        if (Auth::check()) {
            $role=Auth::user()->role;
            if (Auth::user()->role == '1') {
                return redirect()->route('customerDashboard')->withErrors('You’re already logged in.');
            }
            elseif (Auth::user()->role == '2') {
                return redirect()->route('restaurantDashboard')->withErrors('You’re already logged in.');
            }
            elseif (Auth::user()->role == '3') {
                return redirect()->route('adminDashboard')->withErrors('You’re already logged in.');
            }
        }

        return $next($request);
    }
}
