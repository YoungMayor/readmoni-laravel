<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()){
            return redirect()->route('login');
        }

        $user = Auth::user(); 
        $role = $user->role;
        if (!in_array($role, ['admin', 'owner'])){ 
            return redirect()->route('index');
        }
        return $next($request);
    }
}
