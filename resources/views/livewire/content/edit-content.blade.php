<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-3">
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <a href="{{ route('groupShow', $data['group_id']) }}" class="badge badge-pill badge-secondary mr-2 align-middle" style="display: inline-block; height:100%;"><i class="fas fa-arrow-left"></i> Back</a>
                </div>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Content action:</div>
                        <a class="dropdown-item" href="{{route('contentShow', $content->id)}}">Show content</a>
                        <a class="dropdown-item" style="cursor: pointer;" onclick="printExternal('{{route('contentShow', $content->id)}}')">Print content</a>
                        @if (auth()->user()->roles[0]->name == 'pimpinan redaktur' || auth()->user()->id == $redaktur)
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="" wire:click.prevent="deleteContent({{$content->id}})">Delete content</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="updateContent">
                    <div class="form-group">
                        <label for="title" class="@error('data.title') text-danger @enderror">Title</label>
                        <textarea name="title" {{ $edit ? 'disabled' : '' }} id="title" class="form-control @error('data.title') border-danger @enderror" wire:model.defer='data.title' rows="2"></textarea>
                        @error('data.title')
                            <span class="text-danger"><small>{{$message}}</small></span>
                        @enderror
                    </div>
                    <div class="form-group" wire:ignore>
                        <label for="desc" class="@error('data.desc') text-danger @enderror">Description</label>
                        <textarea name="desc" {{ $edit ? 'disabled' : '' }} class="form-control @error('data.desc') border-danger @enderror" id="desc" wire:model.defer='data.desc' rows="7"></textarea>
                    </div>
                    @error('data.desc')
                        <span class="text-danger "><small>{{$message}}</small></span><br>
                    @enderror
                    <div class="form-group">
                        <label for="opening" class="@error('data.opening') text-danger @enderror">Opening</label>
                        <textarea name="opening" id="opening" {{ $edit ? 'disabled' : '' }} class="form-control @error('data.opening') border-danger @enderror" wire:model.defer='data.opening' rows="3"></textarea>
                        @error('data.opening')
                            <span class="text-danger"><small>{{$message}}</small></span>
                        @enderror
                    </div>
                    <div class="form-group" wire:ignore>
                        <label for="content" class="@error('data.content') text-danger @enderror">Content</label>
                        <textarea name="content" {{ $edit ? 'disabled' : '' }} class="form-control @error('data.content') border-danger @enderror" id="isi" wire:model.defer='data.content' rows="7"></textarea>
                    </div>
                    @error('data.content')
                        <span class="text-danger "><small>{{$message}}</small></span><br>
                    @enderror
                    <div class="form-group">
                        <label for="closing" class="@error('data.closing') text-danger @enderror">Closing</label>
                        <textarea name="closing" id="closing" {{ $edit ? 'disabled' : '' }} class="form-control @error('data.closing') border-danger @enderror" wire:model.defer='data.closing' rows="3"></textarea>
                        @error('data.closing')
                            <span class="text-danger"><small>{{$message}}</small></span>
                        @enderror
                    </div>
                    <button {{ $edit ? 'disabled' : '' }} style="float: right;" type="submit" class="btn btn-primary mt-3 btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fas fa-save"></i>
                        </span>
                        <span class="text">Save</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow mb-3">
            <div class="card-header">
                <h6 class="font-weight-bold text-primary my-auto">Manage Content</h6>
            </div>
            <div class="card-body">
                <form action="" wire:submit.prevent="saveManage">
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="@error('data.user_id') text-danger @enderror">Journalist</label>
                                <div class="text-decoration-none d-flex text-gray-600">
                                    <img style="height: 35px;width :35px;" src="{{ isset($journalist->imgprofile) ? asset('storage/'. $journalist->imgprofile) : asset('tamplate/img/undraw_profile.svg') }}" alt="" class="img-profile rounded-circle @error('data.user_id') border border-danger @enderror mr-2">
                                    <div class="d-flex {{ isset($journalist->id) ? 'flex-column' : null }} align-items-center">
                                        <small class="text-capitalize">{{ isset($journalist->name) ? $journalist->name : 'No selected' }}</small>
                                        @if (isset($journalist->id))
                                            <small class="text-xs text-left text-capitalize" style="width: 100%;">{{ $journalist->id }}</small>
                                        @endif
                                    </div>
                                </div>
                                @error('data.user_id')<small class="text-left text-capitalize text-danger">{{$message}}</small>@enderror
                            </div>
                            <div class="form-group col">
                                <label for="">Info</label><br>
                                <span class="badge badge-pill mx-auto badge-secondary"><small>{{$content->created_at->format('d-m-y')}}</small></span>
                                @if ($content->upload)
                                <span class="badge badge-pill badge-info"><small>Uploaded</small></span>
                                @endif
                                @if ($content->verification)
                                <span class="badge badge-pill badge-success"><small>Validated</small></span>
                                @endif
                                @if ($content->verification > $content->deadline && $content->deadline !== null)
                                <span class="badge badge-pill badge-danger"><small>Late</small></span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="deadline" class="@error('data.deadline') text-danger @enderror">Deadline</label>
                           <input type="date" {{ $edit || $own ? 'disabled' : '' }} wire:model.defer='data.deadline' class="form-control">
                            @error('data.deadline')
                                <span class="text-danger"><small>{{$message}}</small></span>
                            @enderror
                        </div>
                    <div class="form-group">
                        <label for="upload">Link upload</label>
                        <input wire:model.defer='data.upload' {{ $edit || $own ? 'disabled' : '' }} type="text" class="form-control" autocomplete="off" id="upload">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" {{ $edit || $own ? 'disabled' : '' }} wire:model.defer='data.verification' class="form-check-input" id="verification">
                        <label class="form-check-label" for="verification">Content Validation</label>
                        @if ($data['verification'] == true)
                            <small id="emailHelp" class="form-text text-muted text-xs m-0 align-middle"><span class="badge align-middle badge-pill badge-success">Validated</span> {{ $data['verification']}}</small>
                        @endif
                    </div>
                    <button {{ $edit || $own ? 'disabled' : '' }} style="float: right;" type="submit" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fas fa-save"></i>
                        </span>
                        <span class="text">Save</span>
                    </button>
                </form>
            </div>
        </div>
        <div class="card shadow mb-3">
            <div class="card-header">
                <h6 class="font-weight-bold text-primary my-auto">File Upload</h6>
            </div>
            @if ($files == true)
            <ul class="list-group list-group-flush">
                @foreach ($files as $file)
                <li href="" class="list-group-item d-flex justify-content-between align-items-center py-2">
                    @if (in_array($file->extension(), explode(',', $typeImage)))
                    <div class="d-flex justify-content-between align-items-center">
                        <img style="height: 30px" class="mr-2" src="{{ $file->temporaryUrl() }}" class="rounded" alt="...">
                        <span class="text-xs">{{ Str::limit($file->getClientOriginalName(), 30) }}</span>
                    </div>
                    @elseif(in_array($file->extension(), explode(',', $typeWord)))
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="fas fa-file-word mr-2 text-primary" ></h4>
                        <span class="text-xs">{{ Str::limit($file->getClientOriginalName(), 30) }}</span>
                    </div>
                    @elseif(in_array($file->extension(), explode(',', $typeExcel)))
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="fas fa-file-excel mr-2 text-success" ></h4>
                        <span class="text-xs">{{ Str::limit($file->getClientOriginalName(), 30) }}</span>
                    </div>
                    @elseif(in_array($file->extension(), explode(',', $typePdf)))
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="fas fa-file-pdf mr-2 text-danger"></h4>
                        <span class="text-xs">{{ Str::limit($file->getClientOriginalName(), 30) }}</span>
                    </div>
                    @elseif(in_array($file->extension(), explode(',', $typeAudio)))
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="fas fa-file-audio mr-2 text-warning" ></h4>
                        <span class="text-xs">{{ Str::limit($file->getClientOriginalName(), 30) }}</span>
                    </div>
                    @elseif(in_array($file->extension(), explode(',', $typeVideo)))
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="fas fa-file-video mr-2 text-info" ></h4>
                        <span class="text-xs">{{ Str::limit($file->getClientOriginalName(), 30) }}</span>
                    </div>
                    @endif
                    {{-- <a href="" class="text-danger"><i class="fas fa-trash" class="mr-3"></i></a> --}}
                </li>
                @endforeach
            </ul> 
            @endif
            <div class="card-body pt-1">
                <div class="text-center">
                    <div wire:loading wire:target="files" class="spinner-border text-primary text-center m-4" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                @if (session()->has('data'))
                <div class="alert mt-2 mb-2 alert-success alert-dismissible fade show" role="alert">
                    {{ session('data') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <form wire:submit.prevent="saveFiles" wire:loading.remove wire:target="files">
                    @error('files.*') <small class="text-xs">{{ $message }}</small><br> @enderror
                    @if( $files == true) 
                    <button {{ $edit ? 'disabled' : '' }} class="btn btn-info btn-icon-split mt-2 btn-sm">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Add</span>
                    </button>
                    @endif
                    <div class="input-group input-group-sm mt-2">
                        <div class="custom-file">
                            <input {{ $edit ? 'disabled' : '' }} type="file" wire:model="files" multiple class="custom-file-input">
                            <label class="custom-file-label" for="inputGroupFile02">Upload file</label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card shadow mb-3">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h6 class="font-weight-bold text-primary my-auto">Data Added</h6>
                    <div>
                        <form class="d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" wire:submit.prevent="updatingSearch" >
                            <div class="input-group input-group-sm">
                                <input type="text" id="journalist" class="form-control border-0 small bg-white" placeholder="seacrh by name..." autocomplete="off" aria-label="Search" aria-describedby="basic-addon2" wire:model.defer="search">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-primary" type="submit">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <ul class="list-group list-group-flush">
                @forelse ($datas as $data)
                    <li class="list-group-item d-flex justify-content-between align-items-center py-2">
                    @if(in_array($data->type, explode(',', $typeImage)))
                        <div class="d-flex justify-content-between align-items-center">
                            <img style="height: 30px" class="mr-2" src="{{asset('storage/'.$data->path)}}" class="rounded" alt="...">
                            <span class="text-xs">{{ Str::limit($data->name, 30)}}</span>
                        </div>
                        <div style="width: 40px" class="d-flex justify-content-between">
                            <a style="cursor: pointer;" class="text-primary" wire:click="downloadFile('{{$data->path}}','{{$data->name}}')"><i class="fas fa-file-download" class=""></i></a>
                            <a style="cursor: pointer;" class="text-danger" wire:click="deleteFile('{{$data->id}}', '{{$data->path}}')"><i class="fas fa-trash" class="mr-3"></i></a>
                        </div>
                    @elseif(in_array($data->type, explode(',', $typeWord)))
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="fas fa-file-word mr-2 text-primary" ></h4>
                            <span class="text-xs">{{ Str::limit($data->name, 30)}}</span>
                        </div>
                        <div style="width: 40px" class="d-flex justify-content-between">
                            <a style="cursor: pointer;" class="text-primary" wire:click="downloadFile('{{$data->path}}','{{$data->name}}')"><i class="fas fa-file-download" class=""></i></a>
                            <a style="cursor: pointer;" class="text-danger" wire:click="deleteFile('{{$data->id}}', '{{$data->path}}')"><i class="fas fa-trash" class="mr-3"></i></a>
                        </div>
                    @elseif(in_array($data->type, explode(',', $typeExcel)))
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="fas fa-file-excel mr-2 text-success" ></h4>
                            <span class="text-xs">{{ Str::limit($data->name, 30)}}</span>
                        </div>
                        <div style="width: 40px" class="d-flex justify-content-between">
                            <a style="cursor: pointer;" class="text-primary" wire:click="downloadFile('{{$data->path}}','{{$data->name}}')"><i class="fas fa-file-download" class=""></i></a>
                            <a style="cursor: pointer;" class="text-danger" wire:click="deleteFile('{{$data->id}}', '{{$data->path}}')"><i class="fas fa-trash" class="mr-3"></i></a>
                        </div>
                    @elseif(in_array($data->type, explode(',', $typePdf)))
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="fas fa-file-pdf mr-2 text-danger" ></h4>
                            <span class="text-xs">{{ Str::limit($data->name, 30)}}</span>
                        </div>
                        <div style="width: 40px" class="d-flex justify-content-between">
                            <a style="cursor: pointer;" class="text-primary" wire:click="downloadFile('{{$data->path}}','{{$data->name}}')"><i class="fas fa-file-download" class=""></i></a>
                            <a style="cursor: pointer;" class="text-danger" wire:click="deleteFile('{{$data->id}}', '{{$data->path}}')"><i class="fas fa-trash" class="mr-3"></i></a>
                        </div>
                    @elseif(in_array($data->type, explode(',', $typeVideo)))
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="fas fa-file-video mr-2 text-info" ></h4>
                            <span class="text-xs">{{ Str::limit($data->name, 30)}}</span>
                        </div>
                        <div style="width: 40px" class="d-flex justify-content-between">
                            <a style="cursor: pointer;" class="text-primary" wire:click="downloadFile('{{$data->path}}','{{$data->name}}')"><i class="fas fa-file-download" class=""></i></a>
                            <a style="cursor: pointer;" class="text-danger" wire:click="deleteFile('{{$data->id}}', '{{$data->path}}')"><i class="fas fa-trash" class="mr-3"></i></a>
                        </div>
                    @elseif(in_array($data->type, explode(',', $typeAudio)))
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="fas fa-file-audio mr-2 text-warning" ></h4>
                        <span class="text-xs">{{ Str::limit($data->name, 30)}}</span>
                    </div>
                    <div style="width: 40px" class="d-flex justify-content-between">
                        <a style="cursor: pointer;" class="text-primary" wire:click="downloadFile('{{$data->path}}','{{$data->name}}')"><i class="fas fa-file-download" class=""></i></a>
                        <a style="cursor: pointer;" class="text-danger" wire:click="deleteFile('{{$data->id}}', '{{$data->path}}')"><i class="fas fa-trash" class="mr-3"></i></a>
                    </div>
                    @endif
                    </li>
                @empty
                <li class="list-group-item text-center py-3">
                    <h3 class="fas fa-times-circle"></h3>
                    <h5 class="font-weight-bold">No data has been added yet</h5>
                </li>
                @endforelse
                @if ($datas->hasPages())
                <li class="list-group-item text-center py-2">
                    {{$datas->links()}}
                </li>
                @endif
            </ul>
        </div>
        <div class="card shadow mb-3">
            <div class="card-header">
                <h6 class="font-weight-bold text-primary my-auto">Comment and info</h6>                    
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <form class="mt-1" wire:submit.prevent="addComment">
                    <div class="form-group">
                        <textarea class="form-control @error('myComment') border-danger @enderror" wire:model.defer="myComment" rows="3"></textarea>
                        @error('myComment')
                            <span class="text-danger"><small>{{$message}}</small></span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary float-right">Add</button>
                    </form>
                </li>
                <li style="list-style-type: none;">
                    <ul class="list-group list-group-flush" style="overflow: auto; max-height: 350px;">
                        @forelse ($comments as $comment)
                            <li class="list-group-item">
                                <div class="media">
                                    <div class="media-body text-xs">
                                        <div class="d-flex align-items-center">
                                            <img class="img-profile rounded-circle" src="{{ $comment->user->ImgProfile ? asset('storage/'.$comment->user->imgprofile) : asset('tamplate/img/undraw_profile.svg') }}" style="height: 30px">
                                            <div class="ml-2">
                                                <h6 class="m-0 font-weight-bold text-capitalize">{{ $comment->user->name }}</h6>
                                                <div><small class="font-weight-bold ">{{ $comment->created_at->format('d, M Y H:i') }}</small></div>
                                            </div>
                                        </div>
                                        <p class="mt-1 mb-0">
                                            {{ $comment->comment }}
                                        </p>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item text-center py-3">
                                <h3 class="fas fa-times-circle"></h3>
                                <h5 class="font-weight-bold">No comment and info</h5>
                            </li>
                        @endforelse
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

<script>
tinymce.init({
    selector: "textarea#desc",
    skin: "bootstrap",
    plugins: "lists fullscreen preview table codesample wordcount charmap emoticons",
    toolbar:
    "undo redo | bold italic underline strikethrough | fullscreen  preview removeformat | formatselect | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist table | forecolor backcolor codesample | charmap emoticons ",
    menubar: false,
    toolbar_mode: 'sliding',
    height: 300,
    readonly : {{$edit}},
    forced_root_block: true,
    setup: (editor) => {
    // Apply the focus effect
        editor.on("init", () => {
            editor.getContainer().style.transition =
            "border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out";
        });
        editor.on('init change', function () {
            editor.save();
        });
        editor.on('change', function (e) {
            @this.set('data.desc', editor.getContent());
        });
        editor.on("focus", () => {
            (editor.getContainer().style.boxShadow =
            "0 0 0 .2rem rgba(0, 123, 255, .25)"),
            (editor.getContainer().style.borderColor = "#80bdff");
        });
        editor.on("blur", () => {
            (editor.getContainer().style.boxShadow = ""),
            (editor.getContainer().style.borderColor = "");
        });
    },
});
tinymce.init({
    selector: "textarea#isi",
    skin: "bootstrap",
    plugins: "lists fullscreen preview table codesample wordcount charmap emoticons",
    toolbar:
    "undo redo | bold italic underline strikethrough | fullscreen  preview removeformat | formatselect | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist table | forecolor backcolor codesample | charmap emoticons ",
    menubar: false,
    toolbar_mode: 'sliding',
    height: 300,
    readonly : {{$edit}},
    forced_root_block: true,
    setup: (editor) => {
    // Apply the focus effect
        editor.on("init", () => {
            editor.getContainer().style.transition =
            "border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out";
        });
        editor.on('init change', function () {
            editor.save();
        });
        editor.on('change', function (e) {
            @this.set('data.content', editor.getContent());
        });
        editor.on("focus", () => {
            (editor.getContainer().style.boxShadow =
            "0 0 0 .2rem rgba(0, 123, 255, .25)"),
            (editor.getContainer().style.borderColor = "#80bdff");
        });
        editor.on("blur", () => {
            (editor.getContainer().style.boxShadow = ""),
            (editor.getContainer().style.borderColor = "");
        });
    },
});
function printExternal(url) {
    var printWindow = window.open( url, 'Print', 'left=200, top=200, width=950, height=500, toolbar=0, resizable=0');
    printWindow.addEventListener('load', function() {
        if (Boolean(printWindow.chrome)) {
            printWindow.print();
            setTimeout(function(){
                printWindow.close();
            }, 500);
        } else {
            printWindow.print();
            printWindow.close();
        }
    }, true);
}
</script>