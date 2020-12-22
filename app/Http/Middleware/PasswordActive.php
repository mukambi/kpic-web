<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PasswordActive
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user()->isActivePassword()){
            return redirect()->route('password.change')->with('error', 'You are required to change your password.');
        }
        return $next($request);
    }
}
