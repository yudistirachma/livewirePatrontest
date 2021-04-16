<div>
    <div class="d-sm-flex justify-content-between align-items-center mb-3">
        <div class="mb-2">
            <h1 class="h4 text-gray-600 font-weight-bold">Group List</h1>
        </div>
        <div class="mb-2">
            <form class="d-sm-inline-block form-inline  navbar-search" wire:submit.prevent="updatingSearch">
                <div class="input-group">
                    <input type="text" class="form-control form-control-sm border-0 small bg-white" placeholder="serach by segment... " aria-label="Search" aria-describedby="basic-addon2" wire:model.defer="search">
                    <div class="input-group-append">
                        <button class="btn btn-primary btn-sm" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="d-flex justify-content-end mb-2">
            <a href="{{ route('groupCreate') }}" class="btn btn-sm btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-folder-plus"></i>
                </span>
                <span class="text">New group</span>
            </a>
        </div>
    </div>
    <div class="row">
        @forelse ($groups as $group)
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-1">
                <a href="{{ route('groupShow', $group->id) }}" class="card-body text-decoration-none">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h6 font-weight-bold text-uppercase mb-0 text-gray-700">{{ Str::limit($group->segment, 15) }}
                            </div>
                            <div class="text-xs mb-0 mr-3 text-gray-600">lead by <strong>{{ Str::limit($group->user->name, 15) }}</strong></div>
                            <div class="text-xs text-gray-600"><small>Jurnalis  &middot; {{$group->users->count()}}</small></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-address-card fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        @empty
        <div class="mx-auto mt-5 text-center">
            <h1 class="fas fa-times-circle"></h1>
            <h4 class="font-weight-bold">Group Empty</h4>
        </div>
        @endforelse
    </div>
    {{ $groups->links() }}
</div>
