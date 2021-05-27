<?php

namespace App\Http\Controllers;

use App\{Content, Group};

class ContentController extends Controller
{
    public function create(Group $group)
    {
        return view('content.create', ['group' => $group]);
    }

    public function edit(Content $content)
    {
        return view('content.edit', compact('content'));
    }

    public function show(Content $content)
    {
        return view('content.show', compact('content'));
    }

    public function onGoing()
    {
        return view('content.onGoing');
    }

    public function late()
    {
        return view('content.late');
    }

    public function validated()
    {
        return view('content.validated');
    }

    public function all()
    {
        return view('content.all');
    }
}
