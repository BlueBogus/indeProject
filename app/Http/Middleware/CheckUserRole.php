<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ... $roles)
    {
        $user = Auth::user();
        if ($user) {
            foreach ($roles as $role) {
                if ($role == $user->role_id) {
                    return $next($request);
                }
            }
        }
        return abort(401);
    }
}
