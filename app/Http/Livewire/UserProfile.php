<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\User;

class UserProfile extends Component
{
    public  $data;

    public function mount(User $id)
    {        
        $this->data = $id->name;
        // $this->data['email'] = $user->email;
        // $this->data['phoneNum'] = $user->phoneNum;
        // $this->data['ktp'] = $user->ktp;
        // $this->data['npwp'] = $user->npwp; 
        // dd($id);
    }

    public function render()
    {
        return view('livewire.test')
        // return view('livewire.user-profile')
            ->extends('layouts.app');
    }
}
