<div class="col-lg-4 mb-3">
  @forelse ($notes as $note)
    <div class="card mb-3">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <h5 class="card-title font-weight-bold text-capitalize">{{ $note->user->name }}</h5>
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
        <div class="card-text">{{ Str::limit($note->highlight, 200)  }}</div>
        <small class="text-xs font-weight-bold">{{ $note->created_at->diffForHumans() }}</small>
      </div>
    </div>
    @break($loop->index == '2')
  @empty
  <div class="card text-center mb-3">
    <div class="card-body">
      <p class="card-text">No <strong>note</strong> at this time</p>
      @if (auth()->user()->id == $user_id or auth()->user()->roles[0]->name == 'pimpinan redaktur')
        <a href="{{ route('noteCreate', $group_id) }}" class="btn btn-sm btn-primary">Add note</a>
      @endif
    </div>
  </div>
  @endforelse
  @if ($more === true)    
    <div class="text-center">
      <a href="{{ route('noteAll', $group_id) }}">See more</a>
    </div>
  @else

  @endif

</div>

