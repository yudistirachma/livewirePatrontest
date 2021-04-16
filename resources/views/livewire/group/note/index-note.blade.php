<div>
    <div class="mb-4 d-flex justify-content-between">
        <h1 class="h4 text-gray-600 font-weight-bold">Note Group <strong class="text-capitalize"> {{ $groupName }} </strong></h1>
        <a href="{{ route('groupShow', $group_id) }}" class="btn btn-secondary btn-icon-split btn-sm mr-3" style="height: 100%">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-left"></i>
            </span>
            <span class="text">Back</span>
        </a>
    </div>
    <div class="row">
        @forelse ($notes as $note)
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card mb-3" style="height: 200px;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="text-capitalize"> {{ $note->user->name }} </h5>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                    <div class="dropdown-header">Note menu:</div>
                                    <a class="dropdown-item" href="{{ route('noteDetail', $note->id) }}">Detail</a>
                                    @if (auth()->user()->id === $note->user_id)
                                    <a class="dropdown-item" href="{{ route('noteEdit', $note->id) }}">Edit</a>
                                    <a class="dropdown-item text-danger" href="{{ route('noteDelete', $note->id) }}">Delete</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-text">{{ Str::limit($note->highlight, 100)  }}</div>
                        <small class="text-xs font-weight-bold">{{ $note->created_at->diffForHumans() }}</small>
                    </div>
                </div>
            </div>
        @empty
        <div class="mx-auto mt-5 text-center">
            <h1 class="fas fa-times-circle"></h1>
            <h4 class="font-weight-bold">Note Empty</h4>
        </div>
        @endforelse
    </div>
    {{ $notes->links() }}
</div>