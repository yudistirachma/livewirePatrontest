<?php

namespace App\Http\Controllers;

use App\Group;

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
        return view('group.groupDetail', ['group' => $group]);
    }
}
