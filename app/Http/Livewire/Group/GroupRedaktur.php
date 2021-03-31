<?php

namespace App\Http\Livewire\Group;

use App\Group;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class GroupRedaktur extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $groups = Group::where('segment', 'like', '%'.$this->search.'%')->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(12);
        

        return view('livewire.group.group-redaktur', ['groups' => $groups]);
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
}
