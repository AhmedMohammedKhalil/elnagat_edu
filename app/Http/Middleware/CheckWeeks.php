<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class CheckWeeks extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if ($this->isSaturdayOrFriday(now())) {
            return redirect()->route("profile");
        }
        return $next($request);
    }


    function isSaturdayOrFriday($date) {
        // Get the day of the week for the given date (1 = Monday, 7 = Sunday)
        $dayOfWeek = date('N', strtotime($date));

        // Check if the day of the week is Saturday (6) or Friday (5)
        return $dayOfWeek == 6 || $dayOfWeek == 5;
    }
}
