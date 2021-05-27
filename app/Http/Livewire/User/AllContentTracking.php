<?php

namespace App\Http\Livewire\User;

use App\Content;
use Livewire\Component;
use Livewire\WithPagination;

class AllContentTracking extends Component
{
    use WithPagination;

    public $search = '';
    public $roles;
    public $user_id;

    public function mount($user)
    {
        $this->roles = $user->roles[0]->name;
        $this->user_id = $user->id;
    }
    
    public function render()
    {
        $contents = $this->all($this->roles);
        
        return view('livewire.user.all-content-tracking', compact('contents'));
    }

    public function all($roles)
    {
        if ($roles == 'pimpinan redaktur') {

            return Content::select('contents.id', 'contents.user_id', 'contents.title', 'contents.verification', 'contents.deadline', 'contents.upload', 'contents.created_at', 'users.name', 'groups.segment')
            ->join('groups', function ($join) {
                $join->on('contents.group_id', '=', 'groups.id');
            })
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'groups.user_id');
            })
            ->where('contents.title', 'like', '%'.$this->search.'%')
            ->orWhere('contents.id', '=', $this->search)
            ->orderByRaw("CASE WHEN contents.user_id = ".$this->user_id. " THEN 0 ELSE 1 END , upload ASC , verification ASC , deadline ASC")
            ->paginate(10);

        }elseif ($roles == 'redaktur') {
            return  Content::select('contents.id', 'contents.user_id', 'contents.title', 'contents.verification', 'contents.deadline', 'contents.upload', 'contents.created_at', 'users.name', 'groups.segment')
            ->join('groups', function ($join) {
                $join->on('contents.group_id', '=', 'groups.id')
                    ->where(function($query)
                    {
                        $query->Where('groups.user_id', '=', auth()->user()->id )
                        ->orWhere('contents.user_id', '=', auth()->user()->id );
                    });
            })
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'groups.user_id');
            })
            ->where('title', 'like', '%'.$this->search.'%')
            ->orWhere('contents.id', '=', $this->search)
            ->orderByRaw("CASE WHEN contents.user_id = ".$this->user_id. " THEN 0 ELSE 1 END , upload ASC , verification ASC , deadline ASC")
            ->paginate(10) ;
            
        }else {
            return  Content::select('contents.id', 'contents.user_id', 'contents.title', 'contents.verification', 'contents.deadline', 'contents.upload', 'contents.created_at', 'users.name', 'groups.segment')
            ->join('groups', function ($join) {
                $join->on('contents.group_id', '=', 'groups.id');
            })
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'groups.user_id');
            })
            ->Where('contents.user_id', '=', $this->user_id)
            ->where(function($query)
            {
                $query->Where('contents.title', 'like', '%'.$this->search.'%')
                ->orWhere('contents.id', '=', $this->search);
            })
            ->orderByRaw("CASE WHEN contents.user_id = ".$this->user_id. " THEN 0 ELSE 1 END , upload ASC , verification ASC , deadline ASC")
            ->paginate(10) ;
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
}
