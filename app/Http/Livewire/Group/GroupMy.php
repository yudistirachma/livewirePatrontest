<?php

namespace App\Http\Livewire\Group;

use Livewire\Component;
use Livewire\WithPagination;

class GroupMy extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $groups = auth()->user()->groups()->where('segment', 'like', '%'.$this->search.'%')->orderBy('created_at', 'desc')->paginate(12);

        return view('livewire.group.group-my', compact('groups'));
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
}
