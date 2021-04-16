<?php

namespace App\Http\Controllers;

use App\{Group, Note, User};
use App\Events\CreateNoteEvent;
use App\Rules\MaxWordsRule;

class NoteController extends Controller
{
    public function show(Note $note)
    {
        $role = User::find($note->user_id)->roles[0]->name;
        return view('note.show', ['note' => $note, 'role' => $role]);
    }

    public function index($group)
    {
        $notes = Note::where('group_id', $group);
        return view('note.index', compact('notes'));
    }

    public function edit(Note $note)
    {
        return view('note.edit', ['note' => $note]);
    }

    public function update(Note $note)
    {
        $data = request()->validate(
            [
                "highlight" => 'required|max:255',
                "note" => ''
            ]
        );

        $result = $note->update($data);

        if ($result) {
            return redirect(route('noteDetail', $note->id))->with('status', 'Note successfully updated');
        } else {
            return redirect(route('noteDetail', $note->id))->with('status', 'Note failed to update !');
        } 
    }

    public function destroy(Note $note)
    {
        $result = $note->delete();

        if ($result) {
            return redirect(route('groupShow',$note->group_id))->with('status', 'Note successfully deleted');
        } else {
            return redirect(route('groupShow',$note->group_id))->with('status', 'Note failed deleted !');
        }   
    }

    public function create(Group $group)
    {
        return view('note.noteCreate', ['group' => $group]);
    }

    public function post(Group $group)
    {
        $data = request()->validate(
            [
                "highlight" => ['required', new MaxWordsRule(20)],
                "note" => ''
            ]
        );

        $data['user_id'] = auth()->id();

        $result = $group->notes()->create($data);

        if ($result) {
            event(new CreateNoteEvent($group, $result));

            return redirect(route('groupShow', $group->id))->with('status', 'Note successfully added');
        } else {
            return redirect(route('groupShow', $group->id))->with('status', 'Note failed added !');
        }   
    }

    public function cleanInput($data) 
    {
        $sanitized = htmlentities($data);
        return($sanitized);
    }
}
