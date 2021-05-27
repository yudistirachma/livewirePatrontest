<?php

namespace App\Http\Livewire\Group\Content;

use App\Content;
use Livewire\{Component, WithPagination};

class ContentGroup extends Component
{
    use WithPagination;

    public $search = '';
    public $group_id, $redaktur, $jurnalis;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount($data)
    {
        $this->group_id = $data->id;
        $this->redaktur = $data->user_id;
        $this->jurnalis = $data->users;
    }

    public function render()
    {
        $user_id = auth()->user()->id;

        if (auth()->user()->roles[0]->name == 'jurnalis') {
            $contents = Content::where('group_id', $this->group_id)
            ->where('user_id', '=', auth()->user()->id)
            ->where('title', 'like', '%'.$this->search.'%')
            ->orderByRaw("verification ASC , deadline ASC, upload ASC")
            ->paginate(5);
        } else {
            $contents = Content::where('group_id', $this->group_id)->where('title', 'like', '%'.$this->search.'%')->orderByRaw("CASE WHEN user_id = {$user_id} THEN 0 ELSE 1 END ,verification ASC , deadline ASC, upload ASC")
            ->paginate(5);
        }        

        return view('livewire.group.content.content-group', compact('contents'));
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
}
