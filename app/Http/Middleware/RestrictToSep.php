<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RestrictToSep
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if ($sep = $user->sep) {
            $rolesToNotRestrict = ['super admin', 'admin'];
            $shouldRestrict = true;
            foreach($request->user()->roles as $role){
                if (in_array($role->name, $rolesToNotRestrict)){
                    $shouldRestrict = false;
                    break;
                }
            }

            if ($shouldRestrict) {
                $request->merge(['region' => $sep->region->id]);
            }
        }


        return $next($request);
    }
}
