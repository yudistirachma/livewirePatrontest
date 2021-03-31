<div class="col-lg-4 mb-3">
  @forelse ($notes as $note)
    <div class="card mb-3">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <h5 class="card-title font-weight-bold">Rahma yudistira</h5>
          <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                <div class="dropdown-header">Note menu:</div>
                <a class="dropdown-item" href="#">Detail</a>
                <a class="dropdown-item" href="#">Edit</a>
                <a class="dropdown-item" href="#">Delete</a>
                
            </div>
          </div>
        </div>
        <div class="card-text">{!! Str::limit($note->note, 100)  !!}</div>
        <small class="text-xs font-weight-bold">{{ $note->created_at->diffForHumans() }}</small>
      </div>
    </div>
    @empty
        <div class="text-center">empty</div>
    @endforelse
  <div class="text-center">
    <a target="_blank" rel="nofollow" href="https://undraw.co/">See more</a>
  </div>
</div>

