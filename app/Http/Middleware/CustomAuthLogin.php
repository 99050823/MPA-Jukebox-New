<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\SessionHelper;

class CustomAuthLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $reqUsername = $request->username;
        $reqPassword = $request->password; 

        $user = User::checkUser($reqUsername);
                
        if ($user !== null) {
            if(Hash::check($reqPassword, $user->password)) {
                SessionHelper::storeUser($user);
                return $next($request);   
            } else {
                return redirect('/error/password');
            }
        } else {
            return redirect('/error/username');
        }
    }
}
