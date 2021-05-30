<?php

namespace App\Http\Livewire;

use App\Content;
use App\User;
use Livewire\Component;
use Livewire\WithPagination;

class TrackingContent extends Component
{
    use WithPagination;

    public $search = '';
    public $query;
    public $roles;

    public function mount($query = 'all')
    {
        $this->query = $query;
        $this->roles = auth()->user()->roles[0]->name;
    }
    
    public function render()
    {
        if ($this->query == 'all') {
            $contents = $this->all($this->roles);
        }elseif ($this->query == 'onGoing') {
            $contents = $this->onGoing($this->roles);
        }elseif ($this->query == 'late') {
            $contents = $this->late($this->roles);
        } else {
            $contents = $this->validated($this->roles);
        }
        
        return view('livewire.tracking-content', compact('contents'));
    }

    public function all($roles)
    {
        $user_id = auth()->user()->id;

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
            ->orderByRaw("CASE WHEN contents.user_id = ".$user_id. " THEN 0 ELSE 1 END , upload ASC , verification ASC , deadline ASC")
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
            ->orderByRaw("CASE WHEN contents.user_id = ".$user_id. " THEN 0 ELSE 1 END , upload ASC , verification ASC , deadline ASC")
            ->paginate(10) ;
            
        }else {
            return  Content::select('contents.id', 'contents.user_id', 'contents.title', 'contents.verification', 'contents.deadline', 'contents.upload', 'contents.created_at', 'users.name', 'groups.segment')
            ->join('groups', function ($join) {
                $join->on('contents.group_id', '=', 'groups.id');
            })
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'groups.user_id');
            })
            ->Where('contents.user_id', '=', $user_id)
            ->where(function($query)
            {
                $query->Where('contents.title', 'like', '%'.$this->search.'%')
                ->orWhere('contents.id', '=', $this->search);
            })
            ->orderByRaw("CASE WHEN contents.user_id = ".$user_id. " THEN 0 ELSE 1 END , upload ASC , verification ASC , deadline ASC")
            ->paginate(10) ;
        }
    }
    public function late($roles)
    {
        $user_id = auth()->user()->id;

        if ($roles == 'pimpinan redaktur') {
            return Content::select('contents.id', 'contents.user_id', 'contents.title', 'contents.verification', 'contents.deadline', 'contents.upload', 'contents.created_at', 'users.name', 'groups.segment')
            ->join('groups', function ($join) {
                $join->on('contents.group_id', '=', 'groups.id');
            })
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'groups.user_id');
            })
            ->whereColumn('verification', '>', 'deadline')
            ->where(function($query)
                {
                    $query->where('contents.title', 'like', '%'.$this->search.'%')
                    ->orWhere('contents.id', '=', $this->search);
                }
            )
            ->orderByRaw("CASE WHEN contents.user_id = ".$user_id. " THEN 0 ELSE 1 END , upload ASC , verification ASC , deadline ASC")
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
            ->whereColumn('contents.verification', '>', 'contents.deadline')
            ->where(function($query)
                {
                    $query->where('contents.title', 'like', '%'.$this->search.'%')
                    ->orWhere('contents.id', '=', $this->search);
                }
            )
            ->orderByRaw("CASE WHEN contents.user_id = ".$user_id. " THEN 0 ELSE 1 END , upload ASC , verification ASC , deadline ASC")
            ->paginate(10) ;
            
        }else {
            return  Content::select('contents.id', 'contents.user_id', 'contents.title', 'contents.verification', 'contents.deadline', 'contents.upload', 'contents.created_at', 'users.name', 'groups.segment')
            ->join('groups', function ($join) {
                $join->on('contents.group_id', '=', 'groups.id');
            })
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'groups.user_id');
            })
            ->Where('contents.user_id', '=', $user_id)
            ->whereColumn('verification', '>', 'deadline')
            ->where(function($query)
            {
                $query->Where('contents.title', 'like', '%'.$this->search.'%')
                ->orWhere('contents.id', '=', $this->search);
            })
            ->orderByRaw("CASE WHEN contents.user_id = ".$user_id. " THEN 0 ELSE 1 END , upload ASC , verification ASC , deadline ASC")
            ->paginate(10) ;
        }
    }

    public function onGoing($roles)
    {
        $user_id = auth()->user()->id;

        if ($roles == 'pimpinan redaktur') {

            return Content::select('contents.id', 'contents.user_id', 'contents.title', 'contents.verification', 'contents.deadline', 'contents.upload', 'contents.created_at', 'users.name', 'groups.segment')
            ->join('groups', function ($join) {
                $join->on('contents.group_id', '=', 'groups.id');
            })
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'groups.user_id');
            })
            ->where('verification', null)
            ->where(function($query)
                    {
                        $query->where('contents.title', 'like', '%'.$this->search.'%')
                        ->orWhere('contents.id', '=', $this->search);
                    })
            ->orderByRaw("CASE WHEN contents.user_id = ".$user_id. " THEN 0 ELSE 1 END , upload ASC , verification ASC , deadline ASC")
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
            ->where('verification', null)
            ->where(function($query)
                {
                    $query->where('contents.title', 'like', '%'.$this->search.'%')
                    ->orWhere('contents.id', '=', $this->search);
                })
            ->orderByRaw("CASE WHEN contents.user_id = ".$user_id. " THEN 0 ELSE 1 END , upload ASC , verification ASC , deadline ASC")
            ->paginate(10) ;
            
        }else {
            return  Content::select('contents.id', 'contents.user_id', 'contents.title', 'contents.verification', 'contents.deadline', 'contents.upload', 'contents.created_at', 'users.name', 'groups.segment')
            ->join('groups', function ($join) {
                $join->on('contents.group_id', '=', 'groups.id');
            })
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'groups.user_id');
            })
            ->Where('contents.user_id', '=', $user_id)
            ->where('verification', null)
            ->where(function($query)
            {
                $query->Where('contents.title', 'like', '%'.$this->search.'%')
                ->orWhere('contents.id', '=', $this->search);
            })
            ->orderByRaw("CASE WHEN contents.user_id = ".$user_id. " THEN 0 ELSE 1 END , upload ASC , verification ASC , deadline ASC")
            ->paginate(10) ;
        }
    }

    public function validated($roles)
    {
        $user_id = auth()->user()->id;

        if ($roles == 'pimpinan redaktur') {

            return Content::select('contents.id', 'contents.user_id', 'contents.title', 'contents.verification', 'contents.deadline', 'contents.upload', 'contents.created_at', 'users.name', 'groups.segment')
            ->join('groups', function ($join) {
                $join->on('contents.group_id', '=', 'groups.id');
            })
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'groups.user_id');
            })
            ->where('verification', '!=', null)
            ->where(function($query)
                    {
                        $query->where('contents.title', 'like', '%'.$this->search.'%')
                        ->orWhere('contents.id', '=', $this->search);
                    })
            ->orderByRaw("CASE WHEN contents.user_id = ".$user_id. " THEN 0 ELSE 1 END , upload ASC , verification ASC , deadline ASC")
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
            ->where('contents.verification', '!=', null)
            ->where(function ($query){
                $query->where('contents.title', 'like', '%'.$this->search.'%')
                ->orWhere('contents.id', '=', $this->search);
            })
            ->orderByRaw("CASE WHEN contents.user_id = ".$user_id. " THEN 0 ELSE 1 END , upload ASC , verification ASC , deadline ASC")
            ->paginate(10) ;
            
        }else {
            return  Content::select('contents.id', 'contents.user_id', 'contents.title', 'contents.verification', 'contents.deadline', 'contents.upload', 'contents.created_at', 'users.name', 'groups.segment')
            ->join('groups', function ($join) {
                $join->on('contents.group_id', '=', 'groups.id');
            })
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'groups.user_id');
            })
            ->Where('contents.user_id', '=', $user_id)
            ->where('contents.verification', '!=', null)
            ->where(function($query)
            {
                $query->Where('contents.title', 'like', '%'.$this->search.'%')
                ->orWhere('contents.id', '=', $this->search);
            })
            ->orderByRaw("CASE WHEN contents.user_id = ".$user_id. " THEN 0 ELSE 1 END , upload ASC , verification ASC , deadline ASC")
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
