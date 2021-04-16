<div class="col-lg-4">
    <div class="card shadow mb-4">
        <div class="card-header py-2">
            <div class="d-flex justify-content-between">
                <h5 class="mr-2 font-weight-bold text-primary my-auto">Journalist</h5>
                <div>
                    <form class="d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"wire:submit.prevent="updatingSearch" >
                        <div class="input-group input-group-sm">
                            <input type="text" id="journalist" class="form-control border-0 small bg-white" placeholder="name or ktp num..."
                                aria-label="Search" aria-describedby="basic-addon2" wire:model.defer="search">
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
        <div class="card-body pt-1">            
            <div class="table-responsive">
                <table class="table table-borderless text-nowrap">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Position</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($users as $employ)
                        <tr wire:click="addData({{$employ}})" style="cursor: pointer;">
                            <td scope="row">
                                <img style="height: 40px;width :40px;" src="{{ isset($employ->imgprofile) ? asset('storage/'. $employ->imgprofile) : asset('tamplate/img/undraw_profile.svg') }}" alt="" class="img-profile rounded-circle mr-2">
                                <span>{{$employ->name}}</span>
                            </td>
                            @if (isset($employ->roles[0]->name))
                                <td class="align-middle">{{$employ->roles[0]->name == 'pimpinan redaktur' ? 'Pimred' : $employ->roles[0]->name }}</td>
                            @else
                                belum {{$employ->name}}
                            @endif
                        </tr>
                    @empty
                    <tr><td colspan="2" class="text-center">User Empty</td></tr>
                    @endforelse
                    </tbody>
                </table>
                {{ $users->links() }}
                {{-- <button wire:click='cek'>cek</button> --}}
            </div>
        </div>
    </div>
</div>