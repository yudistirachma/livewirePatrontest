<?php

namespace App\Http\Controllers;

use App\Group;
use App\Note;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
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

    public function show(Group $group)
    {
        return view('group.groupShow', ['group' => $group]);
    }

}
