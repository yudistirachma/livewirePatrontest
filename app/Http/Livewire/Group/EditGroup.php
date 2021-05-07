<?php

namespace App\Http\Livewire\Group;

use App\Events\CreateGroupEvent;
use App\Group;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class EditGroup extends Component
{
    public $users , $userOld, $search = '';
    public $redakturAdd, $data ;

    protected $listeners = ['newUser' => 'addUser'];

    public function mount($group)
    {
        $this->data['id'] = $group->id;
        $this->data['segment'] = $group->segment;
        $this->data['description'] = $group->desc;
        $this->redakturAdd = $group->user->toArray();
        $this->users = $group->users->toArray();
        $this->userOld = $group->users->toArray();

    }

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

    public function updateGroup()
    {
        $validateData =  $this->validate([
            'data.segment' => "required|max:50|unique:groups,segment,{$this->data['id']}",
            'data.description' => 'required|max:400',
            'redakturAdd' => 'required',
            'users' => 'required'
        ]);

        $group = Group::where('id', $this->data['id'])->update([
            'segment' => $this->data['segment'],
            'desc' => $this->data['description'],
            'user_id' => $this->redakturAdd['id'],
        ]);

        foreach($this->users as $data)
        {
            $input[] = [ 
                'group_id' => $this->data['id'],
                'user_id' => $data['id'],
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        $deleteUser = [];

        foreach($this->userOld as $userOld ){

            foreach ($this->users as $user) {

                if ($userOld['id'] != $user['id']) {

                    if (!isset($deleteUser[$userOld['id']])) {
                        $deleteUser[$userOld['id']] = $userOld ;
                        DB::table('group_user')->where('user_id', $userOld['id'])->where('group_id', $this->data['id'])->delete();
                    }
                }
            }
        }

        $delete = DB::table('group_user')->where('user_id', )->where('group_id', )->delete();

        $hasil = DB::table('group_user')->insertOrIgnore($input);
        
        return Redirect::route('listGroup');
    }

    public function render()
    {      
        return view('livewire.group.edit-group', [
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
