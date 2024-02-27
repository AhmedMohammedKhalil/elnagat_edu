<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class SubAdmin extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if (auth()->check() && auth()->user()->role != "sub_admin") {
            return redirect()->route("profile");
        }
        // if ($request->is('admin') || $request->is('admin/*')) {
        //     if (auth()->check() && auth()->user()->role === 'admin')
        //         return $next($request);
        //     return redirect('/');
        // }

        // if ($request->is('official') || $request->is('official/*')) {
        //     if (auth()->check() && auth()->user()->role === 'official')
        //         return $next($request);
        //     return redirect('/');
        // }

        // if ($request->is('sub_admin') || $request->is('sub_admin/*')) {
        //     if (auth()->check() && auth()->user()->role === 'sub_admin')
        //         return $next($request);
        //     return redirect('/');
        // }
        return $next($request);
    }
}
