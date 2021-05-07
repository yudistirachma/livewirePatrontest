<div class="col-lg mb-4">
    <div class=" mb-3 d-flex justify-content-center">
        <form class=" navbar-search " wire:submit.prevent="updatingSearch" style="width: 50%;">
            <div class="input-group input-group-sm">
                <input type="text" class="form-control border-0 small bg-white" placeholder="search by title..." aria-label="Search" aria-describedby="basic-addon2" wire:model.defer="search">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
    @if (session()->has('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <ul class="list-group mb-3">
        @forelse ($contents as $content)
        <li class="list-group-item">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="font-weight-bold">
                        <a class="text-gray-700" href="{{ route('contentEdit', $content->id) }}">{{ Str::limit($content->title, 150) }}</a>
                    </h6>
                    <div class="d-flex align-items-center">
                        <img class="img-profile rounded-circle" src="{{ isset($content->user->imgprofile) ? asset('storage/'. $content->user->imgprofile) : asset('tamplate/img/undraw_profile.svg') }}" style="height: 30px;width: 30px;">&nbsp;
                        <small class="mx-1 font-weight-bold text-capitalize">{{ Str::limit($content->user->name, 15) }}</small>&middot;<small class="mx-1">{{ $content->deadline ? 'Deadline '. $content->deadline->format('d, M Y') : '' }}</small>
                    </div>
                </div>
                <div class="text-center">
                    <span class="badge badge-pill mx-auto badge-secondary"><small>{{$content->created_at->format('d-m-y')}}</small></span>
                    @if ($content->upload)
                    <span class="badge badge-pill mx-auto badge-info"><small>Uploaded</small></span>
                    @endif
                    @if ($content->verification)
                    <span class="badge badge-pill mx-auto badge-success"><small>Verified</small></span>
                    @endif
                    @if ($content->verification > $content->deadline && $content->deadline !== null)
                    <span class="badge badge-pill mx-auto badge-danger"><small>Late</small></span>
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
    </ul>
    {{ $contents->links() }}
</div>