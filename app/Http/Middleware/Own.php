<?php

namespace App\Http\Middleware;

use Closure;

class Own
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
        $content = $request->route('note');
        $message = 'You do not have access at this page';

        if ( auth()->user()->id === $content->user_id ) {
            return $next($request);
        }

        return abort(403, $message);
    }
}
