<?php

namespace App\Http\Middleware;

use App\Exceptions\UserDeactivated;
use Closure;
use Illuminate\Http\Request;

class Activated
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed|void
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && $request->user()->isActivated()) {
            return $next($request);
        }

        throw new UserDeactivated('You account is not activated. Please contact the Admin or Manager for Assistance.');
//        abort('403', 'You account is not activated. Please contact the Admin or Manager for Assistance.');
    }
}
