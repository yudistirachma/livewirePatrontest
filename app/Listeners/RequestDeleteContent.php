<?php

namespace App\Listeners;

use App\Events\DeleteContent;
use App\Mail\RequestDeleteContent as MailRequestDeleteContent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RequestDeleteContent implements ShouldQueue
{
    public function handle(DeleteContent $event)
    {
        $redaktur = DB::table('users')->where('id', $event->redaktur)->first();

        $pimreds = DB::table('users')
            ->join('model_has_roles', function ($join) {
                $join->on('users.id', '=', 'model_has_roles.model_id')
                    ->where(function($query)
                    {
                        $query->Where('model_has_roles.role_id', 1);
                    });
            })
            ->select('users.name', 'users.id', 'users.email')
            ->get();

        foreach($pimreds as $pimred )
        {
            Mail::to($pimred->email)->send(new MailRequestDeleteContent($event->content, $redaktur));
        }
    }
}
