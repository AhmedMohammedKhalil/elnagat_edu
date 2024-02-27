<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (auth()->check()){
            return redirect('profile');
        }
        // if (auth()->check() && auth()->user()->role === 'admin') {
        //     return redirect('admin/profile');
        // }

        // if (auth()->check() && auth()->user()->role === 'official') {
        //     return redirect('official/profile');
        // }

        // if (auth()->check() && auth()->user()->role === 'sub_admin') {
        //     return redirect('sub_admin/profile');
        // }

        // if (Auth::guard($guard)->check()) {
        //     return redirect()->route('home');
        // }
        return $next($request);
    }
}
