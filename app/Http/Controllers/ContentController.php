<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function create(Group $group)
    {
        return view('content.create', ['group' => $group]);
    }

    public function post()
    {

    }

    public function edit()
    {
        return view('');
    }
}
