<div class="card mb-3">
    <div class="row">
        <img class="card-img-top col-sm-4 m-2" src="{{ asset('tamplate/img/undraw_typewriter_i8xd.svg') }}" alt="Card image cap" style="width : 90%">
        <div class="card-body col-sm-8">
            <h4 class="card-title text-capitalize font-weight-bold">{{ $group->segment }}</h4>
            <p class="card-text">{{ $group->desc }}</p>
            <p class="card-text"><small class="text-muted">Updated : <span class="font-weight-bold" >{{ $group->updated_at->diffForHumans() }}</span> | Created : <span class="font-weight-bold">{{ $group->created_at->toDateString() }}</span></small></p>
        </div>
    </div>
</div>
