<?php

namespace App\Http\Livewire\Group\Note;

use Livewire\Component;

class NoteGroup extends Component
{
    public $notes;

    public function mount($data)
    {
        $this->notes = $data->notes;
    }

    public function render()
    {
        return view('livewire.group.note.note-group');
    }
}
