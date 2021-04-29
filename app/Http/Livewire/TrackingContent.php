<?php

namespace App\Http\Livewire;

use App\Content;
use App\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class TrackingContent extends Component
{
    use WithPagination;

    public $search = '';
    
    public function render()
    {
        $contents = $this->query(auth()->user()->roles[0]->name);

        return view('livewire.tracking-content', compact('contents'));
    }

    protected function query($roles)
    {
        $user_id = auth()->user()->id;

        if ($roles == 'pimpinan redaktur') {

            return Content::where('title', 'like', '%'.$this->search.'%')
            ->orWhere('id', '=', $this->search)
            ->orderByRaw("CASE WHEN user_id = ". $user_id. " THEN 0 ELSE 1 END , verification ASC , deadline ASC, upload ASC")
            ->paginate(10);

        }elseif ($roles == 'redaktur') {
            return  Content::select('contents.id', 'contents.user_id', 'contents.title', 'contents.verification', 'contents.deadline', 'contents.upload', 'contents.created_at')
            ->join('groups', function ($join) {
                $join->on('contents.group_id', '=', 'groups.id')
                    ->where(function($query)
                    {
                        $query->Where('groups.user_id', '=', auth()->user()->id )
                        ->orWhere('contents.user_id', '=', auth()->user()->id );
                    });
            })
            ->where('title', 'like', '%'.$this->search.'%')
            ->orWhere('contents.id', '=', $this->search)
            ->orderByRaw("CASE WHEN contents.user_id = ".$user_id. " THEN 0 ELSE 1 END , verification ASC , deadline ASC, upload ASC")
            ->paginate(10) ;
            
        }else {
            return  Content::Where('user_id', '=', $user_id)
            ->where(function($query)
            {
                $query->Where('title', 'like', '%'.$this->search.'%')
                ->orWhere('id', '=', $this->search);
            })
            ->orderByRaw("CASE WHEN contents.user_id = ".$user_id. " THEN 0 ELSE 1 END , verification ASC , deadline ASC, upload ASC")
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
