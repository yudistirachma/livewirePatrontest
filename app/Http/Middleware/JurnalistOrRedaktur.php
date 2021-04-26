<?php

namespace App\Http\Middleware;

use Closure;

class JurnalistOrRedaktur
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
        $group = $request->route('group');
        $message = 'You do not have access at this page';
        
        $redaktur = $group->user_id;
        $user = auth()->user()->id;
        foreach ($group->users as $value) {
            $jurnalis[] = $value->id ;
        }

        if ( in_array($user, $jurnalis) || $user === $redaktur) 
        {
            return $next($request);
        }
        
        return abort(403, $message);
    }
}
