<?php

namespace App\Http\Livewire\Group\Note;

use App\{Note, Group};
use Livewire\{Component, WithPagination};

class IndexNote extends Component
{
    use WithPagination;

    public $group_id;

    public function mount($group)
    { 
        $this->group_id = $group;
    }

    public function render()
    {
        $notes = Note::where('group_id', '=', $this->group_id)->orderBy('created_at', 'desc')->paginate(4);
        $groupName = Group::where('id', '=', $this->group_id)->first()->segment;

        return view('livewire.group.note.index-note', compact('notes', 'groupName'))
            ->extends('layouts.app', ['livewire' => true, 'title' => 'All Note']);
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
}
