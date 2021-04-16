<?php

namespace App\Http\Livewire\Group\Note;

use Livewire\Component;

class NoteGroup extends Component
{
    public $notes,$group_id,$user_id;

    public function mount($data)
    {
        $this->notes = $data->notes->sortByDesc('created_at');
        $this->group_id = $data->id;
        $this->user_id = $data->user_id;
    }

    public function render()
    {
        if ($this->notes->count() > 3) {
            $more = true;
        }else{
            $more = null;
        }

        return view('livewire.group.note.note-group', ['more' => $more]);
    }
}
