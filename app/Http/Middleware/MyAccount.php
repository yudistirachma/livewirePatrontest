<?php

namespace App\Http\Middleware;

use Closure;

class MyAccount
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
        $id = intval($request->route('user'));
        $user_id = auth()->user()->id;
        $message = 'User does not have the right ID. your ID is '.$user_id ;

        if ( $user_id !== $id) {
            return abort(403, $message);
        }

        return $next($request);
    }
}
