<?php

namespace App\Http\Controllers;

use App\Content;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{    
    public function indexCreate()
    {
        return view('user');
    }

    public function index(User $user)
    {
        $positions = Role::all()->pluck('name');

        $year = now()->format('Y');

        // dd($user->roles[0]->name);

        if ($user->roles[0]->name == "pimpinan redaktur") {
            $late = Content::whereColumn('verification', '>', 'deadline')
                ->whereBetween('created_at', [new Carbon("first day of January {$year}"), new Carbon("last day of December {$year}")])
                ->count();
    
            $notValidated = Content::where('verification', null)
                ->whereBetween('created_at', [new Carbon("first day of January {$year}"), new Carbon("last day of December {$year}")])
                ->count();
    
            $validated = Content::where('verification', '!=', null)
                ->whereBetween('created_at', [new Carbon("first day of January {$year}"), new Carbon("last day of December {$year}")])
                ->count();

        }elseif ($user->roles[0]->name == "redaktur") {
            $late = DB::table('contents')->select(DB::raw("(COUNT(*)) as count, MONTH(contents.created_at) as month"))
                ->join('groups', function ($join) {
                    $join->on('contents.group_id', '=', 'groups.id')
                        ->where(function($query)
                        {
                            $query->Where('groups.user_id', '=', $user->id)
                            ->orWhere('contents.user_id', '=', $user->id );
                        });
                })
                ->whereColumn('verification', '>', 'deadline')
                ->whereBetween('contents.created_at', [new Carbon("first day of January {$year}"), new Carbon("last day of December {$year}")])
                ->count();
            // dd($late);
    
            $notValidated = DB::table('contents')->select(DB::raw("(COUNT(*)) as count, MONTH(contents.created_at) as month"))
                ->join('groups', function ($join) {
                    $join->on('contents.group_id', '=', 'groups.id')
                        ->where(function($query)
                        {
                            $query->Where('groups.user_id', '=', $user->id)
                            ->orWhere('contents.user_id', '=', $user->id );
                        });
                })
                ->where('verification', null)
                ->whereBetween('contents.created_at', [new Carbon("first day of January {$year}"), new Carbon("last day of December {$year}")])
                ->count();
            // dd($notValidated);

            $validated = DB::table('contents')->select(DB::raw("(COUNT(*)) as count, MONTH(contents.created_at) as month"))
                ->join('groups', function ($join) {
                    $join->on('contents.group_id', '=', 'groups.id')
                        ->where(function($query)
                        {
                            $query->Where('groups.user_id', '=', $user->id)
                            ->orWhere('contents.user_id', '=', $user->id );
                        });
                })
                ->where('verification', '!=', null)
                ->whereBetween('contents.created_at', [new Carbon("first day of January {$year}"), new Carbon("last day of December {$year}")])
                ->count();
            // dd($validated);

        }else {
            $late = Content::whereColumn('verification', '>', 'deadline')
                ->where('user_id', '=', $user->id)
                ->whereBetween('created_at', [new Carbon("first day of January {$year}"), new Carbon("last day of December {$year}")])
                ->count();
            // dd($late);
    
            $notValidated = Content::where('verification', null)
                ->where('user_id', '=', $user->id)
                ->whereBetween('created_at', [new Carbon("first day of January {$year}"), new Carbon("last day of December {$year}")])
                ->count();
            // dd($notValidated);

            $validated = Content::where('verification', '!=', null)
                ->where('user_id', '=', $user->id)
                ->whereBetween('created_at', [new Carbon("first day of January {$year}"), new Carbon("last day of December {$year}")])
                ->count();
            // dd($validated);

        }
        
        return view('user.userManage', ["user" => $user, "positions" => $positions, "late" => $late, "notValidated" => $notValidated, 'validated' => $validated]);
    }

    public function update(User $user)
    {
        $attr = request()->validate([
            "role" => "required|exists:roles,name",
        ]);

        isset(request()->status) ? $user->status = true : $user->status = false;

        $user->save();        
        
        if (!$user->getRoleNames()->contains($attr)) 
        {
            $user->syncRoles($attr);
        }

        return redirect(route('employesList'))->with('userManage', "<strong>{$user->name}</strong> with id <strong>{$user->id}</strong> has been manage and update");
    }

}
