<?php

namespace App\Http\Middleware;

use Closure;

class PimredOrRedaktur
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
        $group = $request->route('group') ?? $request->route('note')->group ;
        $message = 'You do not have access rights because you are not Pimred or Redaktur';

        if ( auth()->user()->id === $group->user_id || auth()->user()->roles[0]->name === "pimpinan redaktur") {
            return $next($request);
        }

        return abort(403, $message);
    }
}
