<?php

namespace App\Http\Controllers;

use App\Content;
use App\Group;
use App\Http\Livewire\User\UserList;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    public $group_id;

    public function index()
    {
        return view('group.groupList');
    }

    public function my()
    {
        return view('group.groupMy');
    }

    public function redaktur()
    {
        return view('group.groupRedaktur');
    }

    public function create()
    {
        return view('group.groupCreate');
    }
    
    public function edit(Group $group)
    {
        return view('group.groupEdit', compact('group'));
    }

    public function show(Group $group)
    {
        return view('group.groupShow', ['group' => $group]);
    }
    
    public function detail(Group $group)
    {
        $this->group_id = $group->id;

        $late = Content::join('groups', function ($join) {
            $join->on('contents.group_id', '=', 'groups.id')
            ->where(function($query)
                {
                    $query->Where('groups.id', '=', $this->group_id);
                });
            })
            ->whereColumn('verification', '>', 'deadline')
            ->count();
        // dd($late);

        $notValidated = Content::join('groups', function ($join) {
            $join->on('contents.group_id', '=', 'groups.id')
            ->where(function($query)
                {
                    $query->Where('groups.id', '=', $this->group_id);
                });
            })
            ->where('contents.verification', '=', null)
            ->count();
        // dd($notValidated);

        $validated = Content::join('groups', function ($join) {
            $join->on('contents.group_id', '=', 'groups.id')
            ->where(function($query)
                {
                    $query->Where('groups.id', '=', $this->group_id);
                });
            })
            ->where('contents.verification', '!=', null)
            ->count();
        // dd($validated);

        $userList = User::select(DB::raw('COUNT((contents.verification > contents.deadline)) as late, 
        COUNT(CASE WHEN contents.verification is not null THEN 1 END) as validated, 
        COUNT(CASE WHEN contents.verification is null THEN 1 END) as onGoing, 
        COUNT(*) as total, users.name, users.imgprofile, users.id '))
            ->join('group_user', function ($join) {
                $join->on('group_user.user_id', '=', 'users.id');
            })
            ->join('groups', function ($join) {
                $join->on('groups.id', '=', 'group_user.group_id')
                ->Where('groups.id', $this->group_id);
                
            })
            ->Leftjoin('contents', function ($join) {
                $join->on('contents.user_id', '=', 'users.id')
                ->Where('contents.group_id', $this->group_id);
            })
            ->Where('contents.group_id', $this->group_id)
            ->groupBy('users.name', 'users.id', 'users.imgprofile')
            ->orderByRaw("onGoing desc , total desc")
            ->get();
        
        $users = User::select('users.id', 'users.name', 'users.imgprofile')
        ->join('group_user', function ($join) {
            $join->on('group_user.user_id', '=', 'users.id');
        })
        ->join('groups', function ($join) {
            $join->on('groups.id', '=', 'group_user.group_id')
            ->Where('groups.id', $this->group_id);
        })->get();

        return view('group.groupDetail', compact('group', 'late', 'notValidated', 'validated', 'userList', 'users'));
    }
}
