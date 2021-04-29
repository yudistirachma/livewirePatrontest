<div class="row">
    <div class="col-sm mb-3">
        <form wire:submit.prevent="updateGroup">

            <div class="form-group">
                <label for="segment">Segment</label>
                <input type="text" name="segment" class="form-control @error('data.segment') border-danger @enderror" id="segment" wire:model.defer="data.segment" autocomplete="off">
                @error('data.segment')
                <span class="text-danger"><small>{{$message}}</small></span>
                @enderror
            </div>

            <div class="form-group">
                <label for="redaktur">Redaktur</label>
                {{-- button search redaktur --}}
                <div class="mw-100 navbar-search">
                    <div class="input-group mb-2">
                        <input type="text" class="form-control form-control-sm bg-light border-0 small @error('redakturAdd') border-danger @enderror " placeholder="Search name or ktp number..." aria-label="Search" aria-describedby="basic-addon2" wire:model.debounce.400ms="search">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-sm btn-info" id="redaktur" data-toggle="modal" data-target="#exampleModal" wire:loading.class.remove="btn-info" wire:loading.class="btn btn-sm btn-secondary" wire:loading.attr="disabled">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div>
                    @if (isset($redakturAdd))
                    {{-- {{dd($redakturAdd)}} --}}
                        <img style="height: 30px;width :30px;" src="{{ $redakturAdd['imgprofile'] ? asset('storage/'. $redakturAdd['imgprofile']) : asset('tamplate/img/undraw_profile.svg') }}" alt="" class="img-profile rounded-circle">
                        <span class="small">{{$redakturAdd['name']}}</span>
                    @else
                        <img style="height: 30px;width :30px;" src="http://127.0.0.1:8000/tamplate/img/undraw_profile.svg" alt="" class="img-profile rounded-circle">
                        <span class="small">Not selected</span>
                    @endif
                </div>
                @error('redakturAdd')
                    <span class="text-danger"><small>{{$message}}</small></span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control @error('data.description') border-danger @enderror" id="description" rows="5" name="description" wire:model.defer="data.description"></textarea>
                @error('data.description')
                <span class="text-danger"><small>{{$message}}</small></span>
                @enderror
            </div>
            
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input @error('data.status') border-danger @enderror" type="checkbox" id="status" name="status" wire:model.defer="data.status">
                    <label class="form-check-label" for="status">
                        Status active
                    </label>
                </div>
                @error('status')
                <span class="text-danger"><small>{{$message}}</small></span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-sm">Save</button>
        </form>
    </div>
    <div class="col-sm-7">
        <div class="card @error('users') border-danger @enderror">
            <div class="card-body mx-auto" style="height: 415px;">
                    @forelse ($users as $user)
                    <div style="display: inline-block; border" class="mr-1 mb-2 small rounded border p-1">
                        <img style="height: 30px;width :30px;" src="{{ isset($user['imgprofile']) ? asset('storage/'. $user['imgprofile']) : asset('tamplate/img/undraw_profile.svg') }}" alt="" class="img-profile rounded-circle mr-1">
                        <span>{{$user['name']}}</span>
                        <span style="cursor: pointer;" class="p-1" wire:click='lessUser({{$user['id']}})'>&times;</span>
                    </div>
                    @empty
                    <div style="top: 50%; position:relative;" class="@error('users') text-danger @enderror">No User
                    </div>                 
                    @endforelse
            </div>
        </div>
    </div>
    <!-- Modal redaktur -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Redaktur</h5>
                    <a style="cursor: pointer" data-dismiss="modal" aria-label="Close" wire:click='clearSearch'>
                        <h4> <span aria-hidden="true">&times;</span></h4>
                    </a>
                </div>
                <div class="modal-body">
                        @forelse ($redaktur as $employ)
                            <div class="d-flex justify-content-between mr-3 ml-3 mb-2">
                                <div scope="row">
                                    <img style="height: 40px;width :40px;" src="{{ isset($employ->imgprofile) ? asset('storage/'. $employ->imgprofile) : asset('tamplate/img/undraw_profile.svg') }}" alt="" class="img-profile rounded-circle mr-2">
                                    <span>{{$employ->name}}</span>
                                </div>
                                <div>
                                    <button class="btn btn-circle btn-sm btn-info" ><i class="fas fa-info"></i></button>
                                    <button class="btn btn-circle btn-sm btn-primary" data-dismiss="modal"><i class="fas fa-user-plus" wire:click="addRedaktur({'id':'{{$employ->id}}','name':'{{$employ->name}}','imgprofile':'{{$employ->imgprofile}}','email':'{{$employ->email}}'})"></i></button>
                                </div>
                            </div>
                        @empty
                        <div class="d-flex justify-content-between mr-3 ml-3">User Not Found</div>
                        @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
