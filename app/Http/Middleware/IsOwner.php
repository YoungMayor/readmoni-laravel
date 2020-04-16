<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsOwner
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
        if (!in_array($role, ['owner'])){ 
            return redirect()->route('admin.index');
        }
        return $next($request);
    }
}
