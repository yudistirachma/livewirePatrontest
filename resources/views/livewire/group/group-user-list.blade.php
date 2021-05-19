<div class="card shadow mb-4 col mx-2 p-0">
    <div class="card-header py-3">
        <div class="d-flex justify-content-between">
            <h6 class="mr-2 font-weight-bold text-primary my-auto">Journalist</h6>
            <div>
                <form class="d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"wire:submit.prevent="updatingSearch" >
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm border-0 small bg-white" placeholder="name or id..." aria-label="Search" aria-describedby="basic-addon2" wire:model.defer="search">
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
                        <td scope="row" class="d-flex align-items-center">
                            <img style="height: 40px;width :40px;" src="{{ isset($employ->imgprofile) ? asset('storage/'. $employ->imgprofile) : asset('tamplate/img/undraw_profile.svg') }}" alt="" class="img-profile rounded-circle mr-2">
                            <div>
                                <small class="text-capitalize font-weight-bold">{{$employ->name}}</small><br>
                                <small class="text-capitalize text-xs">{{$employ->id}}</small>
                            </div>
                        </td>
                        @if (isset($employ->roles[0]->name))
                            <td class="align-middle text-capitalize">{{$employ->roles[0]->name == 'pimpinan redaktur' ? 'Pimred' : $employ->roles[0]->name }}</td>
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