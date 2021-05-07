<?php

namespace App\Http\Middleware;

use Closure;

class UserStatus
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
        if (auth()->user()->status == true) 
        {
            return $next($request);
        }
        $url = route('updateProfile', auth()->user()->id);

        return abort(403, "this account has been disabled., please input this to URL 
        {$url} 
        and Logout !!!");
    }
}
