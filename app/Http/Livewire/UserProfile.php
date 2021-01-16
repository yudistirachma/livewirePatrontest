<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\User;
use Illuminate\Support\Facades\Storage;

class UserProfile extends Component
{
    use WithFileUploads;

    public $data;
    public $userData;
    public $photo = [];
    // public $photoKtp;
    // public $photoNpwp;
    public $typeData = ['png', 'gif', 'bmp', 'svg', 'wav', 'mp4',
                        'mov', 'avi', 'wmv', 'mp3', 'm4a',
                        'jpg','jpeg', 'mpga', 'webp', 'wma',];

    protected $rules = [
        'data.name' => 'required|max:50',
        'data.email' => 'required|email',
        'data.phoneNum' => 'digits_between:8,14',
        'data.ktp' => 'digits_between:13,16',
        'data.npwp' => 'digits_between:13,16',
    ];

    public function updatedPhoto()
    {
        $this->validate([
            'photo.*' => 'image|max:5120', // 5MB Max
        ]);
    }

    public function mount(User $user)
    { 
        $this->userData = $user;
        
        $this->data['name'] = $user->name;
        $this->data['email'] = $user->email;
        $this->data['phoneNum'] = $user->phoneNum;
        $this->data['ktp'] = $user->ktp;
        $this->data['npwp'] = $user->npwp;
    }

    public function profileUpdate()
    {
        $this->validate();

        $this->userData->update([
            'name' => $this->data['name'],
            'email' => $this->data['email'],
            'phoneNum' => $this->data['phoneNum'],
            'ktp' => $this->data['ktp'],
            'npwp' => $this->data['npwp'],
        ]);
        
        session()->flash('profile', 'Data successfully updated.');
    }

    public function saveProfile()
    {
        $this->img('imgprofile', 'profile');
    }

    public function saveKtp()
    {
        $this->img('imgktp', 'ktp');
    }

    public function saveNpwp()
    {
        $this->img('imgnpwp', 'npwp');
    }

    public function render()
    {
        return view('livewire.user-profile')
            ->extends('layouts.app', ['livewire' => true]);
    }

    private function img($imgName,$name)
    {
        $this->validate([
            'photo.*' => 'image|max:5120', // 5MB Max
        ]);

        if ($this->userData->$imgName) {
            Storage::delete($this->userData->$imgName);
        }

        $img = $this->photo[$name] ? $this->photo[$name]->store('photo'. $name) : null;

        $this->userData->update([$imgName => $img]);
        
        session()->flash($imgName, "{$name} successfully updated.");
    }
}

