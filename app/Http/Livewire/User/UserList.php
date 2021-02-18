<?php

namespace App\Http\Livewire\User;

use App\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use App\Events\RegisterUserEvent;

class UserList extends Component
{
    use WithPagination;

    public $name, $email, $position, $positionList ;

    public $search = '';

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'position' => 'required|exists:roles,id',
    ];
    
    public function mount()
    {
        $this->positionList = Role::all()->pluck('name','id');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function createUser()
    {
        $this->validate();

        $password = $this->generateRandomString();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($password)
        ]);

        if ($user == true) {
            event(new RegisterUserEvent($this->name,$this->email,$this->position,$password));
            $user->assignRole($this->position);
            session()->flash('userCreate', 'User employer account successfully created.');
        }else {
            session()->flash('userFailed', 'User employer account failed to be created. Please Check your internet connection !');
        }  
    }
       
    public function render()
    {
        return view('livewire.user.user-list', ['users' =>  User::where('name', 'like', '%'.$this->search.'%')->orWhere('ktp', 'like', '%'.$this->search.'%')->paginate(5)] );
    }

    private function generateRandomString($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
}
