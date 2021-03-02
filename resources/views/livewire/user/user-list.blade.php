<div class="row">
    <div class="card shadow mb-4 mx-2 col-lg-8 p-0">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary my-auto">User list</h6>
                
                <div>
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"wire:submit.prevent="updatingSearch" >
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small bg-white" placeholder="Search name and nik..."
                                aria-label="Search" aria-describedby="basic-addon2" wire:model.defer="search">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body pt-1">
            <div class="table-responsive">
                <table class="table table-borderless text-nowrap">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Position</th>
                        <th scope="col">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $employ)
                        <tr>
                            <th scope="row">
                                <img style="height: 40px;width :40px;" src="{{ isset($employ->imgprofile) ? asset('storage/'. $employ->imgprofile) : asset('tamplate/img/undraw_profile.svg') }}" alt="" class="img-profile rounded-circle mr-2">
                                <span>{{$employ->name}}</span>
                            </th>
                            @if (isset($employ->roles[0]->name))
                                <td class="align-middle">{{$employ->roles[0]->name == 'pimpinan redaktur' ? 'pimred' : $employ->roles[0]->name }}</td>
                            @else
                                belum {{$employ->name}}
                            @endif
                            <td class="align-middle">Active</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $users->links() }}
        </div>
    </div>
    <div class="card shadow mb-4 mx-2 col p-0">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Create new emloyer user</h6>
        </div>
        <div class="card-body">
            @if (session()->has('userCreate'))
                <div class="alert alert-success">
                    {{ session('userCreate') }}
                </div>
            @endif
            @if (session()->has('userFailed'))
                <div class="alert alert-danger">
                    {{ session('userFailed') }}
                </div>
            @endif
            <form wire:submit.prevent="createUser">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control @error('name') border-danger @enderror" id="name" placeholder="Name" wire:model.defer="name">
                    @error('name')
                    <span class="text-danger"><small>{{$message}}</small></span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputState">Position</label>
                    <select id="inputState" name="position" class="form-control @error('position') border-danger @enderror" wire:model.defer="position">
                    <option selected>Choose...</option>
                    @foreach ($positionList as $key => $position)
                    <option value="{{$key}}">{{$position}}</option>
                    @endforeach
                    </select>
                    @error('position')
                    <span class="text-danger"><small>{{$message}}</small></span>
                    @enderror
                  </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" name="email" class="form-control @error('email') border-danger @enderror" id="email" aria-describedby="emailHelp" placeholder="Email" wire:model.defer="email">
                    @error('email')
                    <span class="text-danger"><small>{{$message}}</small></span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
            </form>
        </div>
    </div>
</div>
