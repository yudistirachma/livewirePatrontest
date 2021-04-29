<?php

namespace App\Http\Livewire\Group;

use App\User;
use Livewire\Component;
use Livewire\WithPagination;

class GroupUserList extends Component
{
    use WithPagination;

    protected $listeners = ['lessData' => 'deleteData'];

    public $search = '', $data = [];

    public function mount($users = []){
        $this->data = $users;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    

    public function addData($value)
    {
        $this->emit('newUser', $value);
        return $this->data[] = $value;        
    }
    
    public function deleteData($id)
    {
        foreach ($this->data as $key => $user) {
            if ($user['id'] === $id) {
                unset($this->data[$key]);
            }
        }
    }

    public function cek()
    {
        dd($this->data);
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        $id = [];
        foreach ($this->data as $value ) 
        {
            $id[] = $value['id'];
        }

        $user = User::whereNotIn("id", $id)->where(function($query)
        {
            $query->Where('name', 'like', '%'.$this->search.'%')
            ->orWhere('id', 'like', '%'.$this->search.'%');
        });

        return view('livewire.group.group-user-list', ['users' =>  $user->paginate(5)]);
    }
}
