<?php

namespace App\Http\Livewire\Group;

use App\Events\CreateGroupEvent;
use App\Group;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class CreateGroup extends Component
{
    public $users = [], $search = '';
    public $redakturAdd, $data ;

    protected $listeners = ['newUser' => 'addUser'];

    protected $rules = [
        'data.segment' => 'required|max:50|unique:groups,segment',
        'data.description' => 'required|max:400',
        'redakturAdd' => 'required',
        'users' => 'required'
    ];

    public function addUser($value)
    {
        $this->users[] = $value;
    }

    public function lessUser($id)
    {    
        foreach ($this->users as $key => $user) {
            if ($user['id'] === $id) {
                unset($this->users[$key]);
            }
        }

        $this->emit('lessData', $id);
    }

    public function clearSearch()
    {
        $this->search = '';
        $this->updatingSearch();
    }

    public function addRedaktur($employ)
    {
        if ($employ['imgprofile'] == '') {
            $employ['imgprofile'] = null;
        }
        $this->redakturAdd = $employ;
        $this->clearSearch();
    }

    public function saveGroup()
    {
        $this->validate();

        $group = Group::create([
            'segment' => $this->data['segment'],
            'desc' => $this->data['description'],
            'user_id' => $this->redakturAdd['id'],
        ]);

        $input = [];

        foreach($this->users as $data)
        {
            $input[] = [ 
                'group_id' => $group->id,
                'user_id' => $data['id'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }

        $hasil = DB::table('group_user')->insertOrIgnore($input);

        if ($hasil > 0) {
            event(new CreateGroupEvent($group, $this->redakturAdd, $this->users));

            $this->users = [];
            $this->data = null;

            // session()->flash('groupCreated', 'Group successfully created.');

            return Redirect::route('listGroup');
        }
    }

    public function render()
    {                        
        return view('livewire.group.create-group', [
            'redaktur' => DB::table('users')
                        ->join('model_has_roles', function ($join) {
                            $join->on('users.id', '=', 'model_has_roles.model_id')
                                ->where(function($query)
                                {
                                    $query->Where('users.name', 'like', '%'.$this->search.'%')
                                    ->orWhere('users.ktp', 'like', '%'.$this->search.'%');
                                });
                        })
                        ->join('roles', function ($join) {
                            $join->on('roles.id', '=', 'model_has_roles.role_id')
                                ->where('role_id', '=', '2');
                        })
                        ->select('users.name', 'users.imgprofile', 'users.id', 'users.email')
                        ->get()
            ]);
    }
}
