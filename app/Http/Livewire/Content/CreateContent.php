<?php

namespace App\Http\Livewire\Content;

use App\Content;
use App\Rules\MaxWordsRule;
use App\User;
use Livewire\Component;

class CreateContent extends Component
{
    public $group, $data, $journalist;
    public $redaktur;
    
    protected $listeners = ['newJournalist' => 'addJournalist'];
    
    public function mount($group)
    {
        $this->group = $group;
        $this->data['group_id'] = $group->id ;
        $this->redaktur = $group->user_id;

        if (auth()->user()->id !== $this->redaktur) {
            $this->data['user_id'] = auth()->user()->id;
            $this->data['jurnalis'] = true;
        }      
    }

    public function addJournalist(User $value)
    {
        $this->journalist = $value;
        $this->data['user_id'] = $value->id;
    }

    public function createContent()
    {
        if (auth()->user()->id == $this->redaktur) {
            $validateData = $this->validate([
                'data.title' => ['required', 'unique:contents,title', new MaxWordsRule(11)],
                'data.user_id' => 'required',
                'data.desc' => 'required',
                'data.deadline' => 'required|date',
                'data.group_id' => 'required',
            ]);
        }else {
            $validateData = $this->validate([
                'data.title' => ['required', 'unique:contents,title', new MaxWordsRule(11)],
                'data.user_id' => 'required',
                'data.desc' => 'required',
                'data.group_id' => 'required',
            ]);
        }
        
        $result = Content::create($validateData['data']);
        
        if ($result) {
            session()->flash('status', 'Content successfully created.');
            return redirect()->to(route('groupShow', $this->data['group_id']));
        }
    }

    public function render()
    {
        return view('livewire.content.create-content');
    }
}
