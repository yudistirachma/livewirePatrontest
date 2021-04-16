<div class="col-lg-8 mb-3">
    <div class=" mb-3 d-flex justify-content-between">
        <form class=" navbar-search " wire:submit.prevent="updatingSearch" style="width: 50%;">
            <div class="input-group input-group-sm">
                <input type="text" class="form-control border-0 small bg-white" placeholder="name or ktp num..." aria-label="Search" aria-describedby="basic-addon2" wire:model.defer="search">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>
        <a href="{{ route('contentCreate', $group_id) }}" class="btn btn-sm btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-folder-plus"></i>
            </span>
            <span class="text"><small class="font-weight-bold">Content</small></span>
        </a>
    </div>
    @if (session()->has('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <ul class="list-group">
        @forelse ($contents as $content)
        <li class="list-group-item">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="font-weight-bold">{{ Str::limit($content->title, 15) }}</h6>
                    <div class="d-flex align-items-center">
                        <img class="img-profile rounded-circle" src="http://localhost:8000/tamplate/img/undraw_profile.svg" style="height: 30px">
                        <small class="mx-1 font-weight-bold">{{ Str::limit($content->user->name, 15) }}</small>&middot;<small class="mx-1">Deadline {{ $content->deadline->format('d, M Y') }}</small>
                    </div>
                </div>
                <div class="text-center">
                    @if ($content->verification > $content->deadline)
                    <span class="badge badge-pill mx-auto badge-danger"><small>Late</small></span>
                    @endif
                    @if ($content->upload)
                    <span class="badge badge-pill mx-auto badge-info"><small>Uploaded</small></span>
                    @endif
                    @if ($content->verification)
                    <span class="badge badge-pill mx-auto badge-success"><small>Verified</small></span>
                    @endif
                </div>
            </div>
        </li> 
        @empty
        <div class="mx-auto mt-4 text-center">
            <h1 class="fas fa-times-circle"></h1>
            <h4 class="font-weight-bold">Content Empty</h4>
        </div>
        @endforelse
        {{ $contents->links() }}
    </ul>
</div>
