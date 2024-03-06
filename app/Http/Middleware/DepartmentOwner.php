<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class DepartmentOwner extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if (auth()->check() && auth()->user()->role != "department-owner") {
            return redirect()->route("profile");
        }

        return $next($request);
    }
}
