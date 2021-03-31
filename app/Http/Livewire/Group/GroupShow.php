<?php

namespace App\Http\Livewire\Group;

use Livewire\Component;

class GroupShow extends Component
{
    public $group;

    public function mount($data)
    {
        $this->group = $data;
    }

    public function render()
    {
        return view('livewire.group.group-show');
    }
}
