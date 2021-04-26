<?php

namespace App\Http\Middleware;

use Closure;

class OwnOrRedaktur
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
        $content = $request->route('content');
        $message = 'You do not have access at this page';

        if ( auth()->user()->id === $content->user_id or auth()->user()->id === $content->group->user_id or auth()->user()->roles[0]->name === "pimpinan redaktur") 
        {
            return $next($request);
        }

        return abort(403, $message);
    }
}
