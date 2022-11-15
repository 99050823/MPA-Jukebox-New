<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class CustomAuthRegister
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

        if ($user == null) {
            User::insertUser($reqUsername, $reqPassword);
            return $next($request);
        } else {
            return redirect('/error/noUniqueUsername');
        }
    }
}
