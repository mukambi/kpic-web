<?php

namespace App\Http\Middleware;

use App\Exceptions\UnauthorizedRole;
use Closure;
use Illuminate\Http\Request;

class UsersOnly
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     * @throws UnauthorizedRole
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $user = $request->user();
            if (!$user->hasRole(['user'])) {
                throw new UnauthorizedRole('Access Denied! Access is for users with user role.');
            }
        }
        return $next($request);
    }
}
