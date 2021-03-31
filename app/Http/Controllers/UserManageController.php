<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;;

class UserManageController extends Controller
{
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

        if ($user->getRoleNames()->contains($attr)) {
            return redirect(route('employesList'));
        } else {
            $user->syncRoles($attr);
            session()->flash('success', "{$user->name} with id {$user->id} has been manage");
            return redirect(route('employesList'));
        }
    }
}
