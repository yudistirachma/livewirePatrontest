<?php

namespace App\Http\Livewire\Content;

use App\Content;
use App\Rules\MaxWordsRule;
use App\User;
use Livewire\Component;

class CreateContent extends Component
{
    public $group, $data, $journalist;

    public $k = 1;
    
    protected $listeners = ['newJournalist' => 'addJournalist'];
    
    public function mount($group)
    {
        $this->group = $group;
        $this->data['group_id'] = $group->id ;
    }

    public function addJournalist(User $value)
    {
        $this->journalist = $value;
        $this->data['user_id'] = $value->id;
    }

    public function createContent()
    {
        $validateData = $this->validate([
            'data.title' => ['required', 'unique:contents,title', new MaxWordsRule(11)],
            'data.user_id' => 'required',
            'data.desc' => 'required',
            'data.deadline' => 'required',
            'data.group_id' => 'required',
        ]);

        $result = Content::create($validateData['data']);
        
        if ($result) {
            return redirect(route('myGroup'));
        }
    }

    public function render()
    {
        return view('livewire.content.create-content');
    }
}
