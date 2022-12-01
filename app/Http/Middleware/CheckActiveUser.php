<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\SessionHelper;

class CheckActiveUser
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
        $user = SessionHelper::getUser();
        
        if ($user == null) {
            return redirect('/error/noActiveUser');
        } else {
            return $next($request); 
        }
    }
}
