<?php

namespace App\Http\Livewire\Content;

use App\{Comment, Content,Data};
use App\Events\CommentEvent;
use App\Events\ValidationEvent;
use App\Rules\MaxWordsRule;
use Illuminate\Support\Facades\Storage;
use Livewire\{Component, WithFileUploads, WithPagination};

class EditContent extends Component
{
    use WithFileUploads, WithPagination;

    public $data, $journalist, $content, $redaktur, $own, $myComment;
    public $files = [];
    public $typeWord = 'doc,docm,docx';
    public $typeExcel = 'xls,xlm,xla,xlc,xlt,xlw,xlsx';
    public $typePdf = 'pdf';
    public $typeImage = 'jpeg,jpg,jpe,png,svg,bmp,webp';
    public $typeVideo = '3gp,mp4,mp4v,mpg4,mov,avi,wmv,mkv';
    public $typeAudio = 'mpga,wav,m4a,mp3,wma';
    public $edit = 0;
    public $search = '';    

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount(Content $content)
    {
        $this->content = $content;
        $this->journalist = $content->user;
        $this->redaktur = $content->group->user_id;
        if (auth()->user()->id !== $this->redaktur && auth()->user()->id !== $this->content->user_id) {
            $this->edit = 1;
        }
        if (auth()->user()->id == $content->user_id && auth()->user()->id !== $this->redaktur) {
            $this->own = true;
        }
        
        $this->data['group_id'] = $content->group_id;
        $this->data['title'] = $content->title;     
        $this->data['desc'] = $content->desc;     
        $this->data['opening'] = $content->opening;     
        $this->data['content'] = $content->content;     
        $this->data['closing'] = $content->closing;
        $this->data['verification'] = $content->verification != null ? $content->verification->format('l, d F Y') : $content->verification;
        $this->data['upload'] = $content->upload;
        $this->data['deadline'] = $content->deadline ? date('Y-m-d', strtotime($content->deadline)) : $content->deadline;
    }

    public function updateContent()
    {
        if (auth()->user()->id !== $this->redaktur && auth()->user()->id !== $this->content->user_id) 
        {
            session()->flash('status', 'Content failed updated.');
            return redirect()->to(route('groupShow', $this->data['group_id']));
        }
        if(auth()->user()->id == $this->redaktur or auth()->user()->id == $this->content->user_id){
            $validateData = $this->validate([
                'data.title' => ["required", "unique:contents,title,{$this->content->id}", new MaxWordsRule(11)],
                'data.desc' => 'required',
                'data.opening' => [new MaxWordsRule(35)],
                'data.content' =>'',
                'data.closing' => [new MaxWordsRule(35)],
            ]);          

            $result = $this->content->update($validateData['data']);
            
            if ($result) {
                session()->flash('status', 'Content successfully updated.');
            }else {
                session()->flash('status', 'Content failed updated.');
            }
        }else {
            session()->flash('status', 'Content failed updated.');
        }
        return redirect()->to(route('groupShow', $this->data['group_id']));
    }

    public function saveManage()
    {
        if (auth()->user()->id !== $this->redaktur) 
        {
            session()->flash('status', 'Content failed updated.');
            return redirect()->to(route('groupShow', $this->data['group_id']));
        }
        
        $this->validate([
            'data.upload' => 'max:255',
            'data.verification' => '',
            'data.deadline' => '',
        ]);

        if ($this->data['verification'] == true) {

            if ($this->content->verification == true) {

                $this->content->update([
                    "deadline" => $this->data['deadline'],
                    "upload" => $this->data['upload'],
                ]);

            } else {
                $this->data['verification'] = date('d-m-Y', strtotime(now()));

                $this->content->update([
                    "deadline" => $this->data['deadline'],
                    "upload" => $this->data['upload'],
                    "verification" => $this->data['verification'],
                ]);

                event(new ValidationEvent($this->content));

                $this->data['verification'] = $this->content->verification->format('l, d F Y'); 
            }
        }else {
            $this->data['verification'] = null;

            $this->content->update([
                "deadline" => $this->data['deadline'],
                "upload" => $this->data['upload'],
                "verification" => $this->data['verification'],
            ]);

            $this->data['verification'] = $this->content->verification;
        }
    }

    public function saveFiles()
    {
        if (auth()->user()->id !== $this->redaktur && auth()->user()->id !== $this->content->user_id) 
        {
            session()->flash('status', 'Content failed updated.');
            return redirect()->to(route('groupShow', $this->data['group_id']));
        }

        $this->validate([
            'files.*' => "required|mimes:{$this->typeWord},{$this->typeExcel},{$this->typePdf},{$this->typeImage},{$this->typeVideo},{$this->typeAudio}|max:100000", // 100MB Max
        ]);

        foreach ($this->files as $file)
        {
            $path = $file->store("data/content/{$this->content->id}");
            $files[] = [
                "content_id" => $this->content->id,
                "name" => $file->getClientOriginalName(),
                "type" => $file->extension(),
                "path" => $path,
                "created_at" => now(),
                "updated_at" => now(),
            ];
        }

        $result = Data::insert($files);

        if ($result) {
            $this->files = null;
            session()->flash('data', "data file successfully added.");
        }
    }

    public function downloadFile($path, $name)
    {
        return Storage::download($path, $name);
    }

    public function deleteFile($id,$path)
    {
        if (auth()->user()->id !== $this->redaktur && auth()->user()->id !== $this->content->user_id) 
        {
            session()->flash('status', 'Content failed updated.');
            return redirect()->to(route('groupShow', $this->data['group_id']));
        }
        Data::destroy($id);
        Storage::delete($path);
        session()->flash('data', "data file successfully delete.");
    }

    public function addComment()
    {
        $this->validate([
            "myComment" => 'required|max:255'
        ]);

        $result = $this->content->comments()->create([
                "user_id" => auth()->user()->id,
                "comment" => $this->myComment, 
                "created_at" => now(),
                "updated_at" => now() 
        ]);

        if ($result) {
            event(new CommentEvent($this->content, $result));
            session()->flash('data', "Comment successfully added.");
            $this->myComment = '';
        }
    }

    public function render()
    {
        $datas = Data::where('content_id', $this->content->id)->where('name', 'like', '%'.$this->search.'%')->paginate(5);

        $comments = Comment::where('content_id', $this->content->id)->orderBy('created_at', 'desc')->get();

        return view('livewire.content.edit-content', compact('datas', 'comments'));

    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
}
