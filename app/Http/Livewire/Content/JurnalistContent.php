<?php

namespace App\Http\Livewire\Content;

use App\Helpers\General\CollectionHelper;
use App\User;
use Livewire\{Component, WithPagination};

class JurnalistContent extends Component
{
    use WithPagination;

    public $search = '';
    public $group ;
    protected $journalist = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount($group)
    {
        $this->group = $group;
    }

    public function addData($value)
    {
        $this->journalist = $value;
        $this->emit('newJournalist', $value);
    }

    public function render()
    {
        $search = $this->search;

        if ($search === '') {
            $users = CollectionHelper::paginate($this->group->users->whereNotIn('id', $this->journalist), 8);
        }else {
            $users = CollectionHelper::paginate($this->group->users->whereNotIn('id', $this->journalist)
            ->filter(function ($item) use ($search) {
                if (stristr($item->name, $search) or stristr($item->id, $search)) {
                   return true;
                }
            }), 8);
        }

        return view('livewire.content.jurnalist-content', compact('users'));
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
}
