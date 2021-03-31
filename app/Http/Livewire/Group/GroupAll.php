<?php

namespace App\Http\Livewire\Group;

use App\Group;
use Livewire\Component;
use Livewire\WithPagination;

class GroupAll extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {        
        $groups = Group::where('segment', 'like', '%'.$this->search.'%')->orderBy('created_at', 'desc')->paginate(12);
        
        return view('livewire.group.group-all', compact('groups'));
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
}
