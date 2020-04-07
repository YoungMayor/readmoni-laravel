<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserActivated
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
        $userKey = $user->user_key; 
        if ($user->account_activated != 'y'){
            return redirect()->route('user.activate.page', [
                'key' => $userKey
            ]);
        }
        return $next($request);
    }
}
