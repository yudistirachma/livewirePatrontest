<?php

namespace App\Http\Middleware;

use App\Group;
use Closure;

class Jurnalis
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

        if (!isset($group->users)) {
            $group = Group::where('id', $group)->first();
        }
        
        $redaktur = $group->user_id;
        $user = auth()->user()->id;
        foreach ($group->users as $value) {
            $jurnalis[] = $value->id ;
        }

        $message = 'You do not have access at this page';

        if ( in_array($user, $jurnalis) || auth()->user()->roles[0]->name === "pimpinan redaktur" || $user === $redaktur) 
        {
            return $next($request);
        }

        return abort(403, $message);
    }
}
