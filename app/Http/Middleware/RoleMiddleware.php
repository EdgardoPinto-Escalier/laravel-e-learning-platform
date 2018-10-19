<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param $role
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
      if ( auth()->user()->role_id !== (int) $role) {
      abort(401, ("401 Unauthorized Access! You can't access this page..."));
      }
        return $next($request);
    }
}
