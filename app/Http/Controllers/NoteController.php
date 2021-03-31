<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function create(Group $group)
    {
        return view('note.noteCreate', ['group' => $group]);
    }

    public function post(Group $group)
    {
        $data = request()->validate(
            [
                "highlight" => 'required',
                "note" => 'required'
            ]
        );

        $data['user_id'] = auth()->id();

        $result = $group->notes()->create($data);

        if ($result) {
            return redirect(route('groupShow', $group->id))->with('status', 'Note added');
        } else {
            return redirect(route('groupShow', $group->id))->with('status', 'Note failed added !');
        }   
    }

    public function edit()
    {
        return view('');
    }

    public function cleanInput($data) 
    {
        $sanitized = htmlentities($data);
        return($sanitized);
    }
}
