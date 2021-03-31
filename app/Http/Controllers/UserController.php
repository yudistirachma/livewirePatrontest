<?php

namespace App\Http\Controllers;

use App\User;
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
        
        return view('user.userManage', ["user" => $user, "positions" => $positions]);
    }

    public function update(User $user)
    {
        $attr = request()->validate([
            "role" => "required|exists:roles,name"
        ]);

        if ($user->getRoleNames()->contains($attr)) 
        {
            
            return redirect(route('employesList'))->with('userManage', "<strong>{$user->name}</strong> with id <strong>{$user->id}</strong> has been manage and update");
        } else 
        {
            $user->syncRoles($attr);

            return redirect(route('employesList'))->with('userManage', "<strong>{$user->name}</strong> with id <strong>{$user->id}</strong> has been manage and update");
        }
    }

}
