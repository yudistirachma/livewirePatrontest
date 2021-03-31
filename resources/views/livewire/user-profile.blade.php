<div class="row">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header py-3">
                <div class="m-0 font-weight-bold text-primary">Personal data information</div>
                @if (session()->has('profile'))                    
                    <div class="alert mt-3 mb-0 alert-success alert-dismissible fade show" role="alert">
                        {{ session('profile') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
            <div class="card-body">
                <form wire:submit.prevent="profileUpdate">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" class="form-control @error('data.name') border-danger @enderror" autocomplete="off" id="name" name="name" wire:model.defer='data.name' value="{{$data['name']}}">
                      @error('data.name')
                        <span class="text-danger"><small>{{$message}}</small></span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control @error('data.email') border-danger @enderror" autocomplete="off" id="email" name="email" wire:model.defer='data.email' value="{{$data['email']}}" placeholder="aku@email.com">
                      @error('data.email')
                        <span class="text-danger"><small>{{$message}}</small></span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="phoneNum">Phone number</label>
                      <input type="num" class="form-control @error('data.phoneNum') border-danger @enderror" autocomplete="off" id="phoneNum" wire:model.defer='data.phoneNum' value="{{$data['phoneNum']}}" name="phoneNum">
                      @error('data.phoneNum')
                        <span class="text-danger"><small>{{$message}}</small></span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="ktp">KTP (kartu tanda penduduk)</label>
                      <input type="num" class="form-control @error('data.ktp') border-danger @enderror" autocomplete="off" id="ktp" name="ktp" wire:model.defer='data.ktp' value="{{$data['ktp']}}">
                      @error('data.ktp')
                        <span class="text-danger"><small>{{$message}}</small></span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="npwp">NPWP (nomor pokok wajib pajak)</label>
                      <input type="num" class="form-control @error('data.npwp') border-danger @enderror" autocomplete="off" id="npwp" name="npwp" wire:model.defer='data.npwp' value="{{$data['npwp']}}">
                      @error('data.npwp')
                        <span class="text-danger"><small>{{$message}}</small></span>
                      @enderror
                    </div>
                    <div class="float-right">
                        <button class="btn btn-primary btn-icon-split" wire:loading.remove>
                            <span class="icon text-white-50"><li class="fas fa-check"></li></span>
                            <span class="text">Save</span>
                        </button>
                        <div class="btn btn-warning btn-icon-split" style="cursor:wait" wire:loading wire:target="profileUpdate">
                            <span class="icon text-white-50"><li class="fas fa-info-circle"></li></span>
                            <span class="text">loading....</span>   
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header py-3">
                <div class="m-0 font-weight-bold text-primary">Create new password</div>
                @if (session()->has('password'))                    
                    <div class="alert mt-3 mb-0 alert-warning alert-dismissible fade show" role="alert">
                        {{ session('password') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
            <div class="card-body">
                <form wire:submit.prevent="newPassword">
                    <div class="form-group">
                      <label for="password">New password</label>
                      <input type="password" class="form-control @error('password') border-danger @enderror" autocomplete="off" id="password" name="password" wire:model.defer='password'>
                      @error('password')
                        <span class="text-danger"><small>{{$message}}</small></span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="confirmPassword">Confirm new password</label>
                      <input type="password" class="form-control @error('confirmPassword') border-danger @enderror" autocomplete="off" id="confirmPassword" name="confirmPassword" wire:model.defer='confirmPassword'>
                      @error('confirmPassword')
                        <span class="text-danger"><small>{{$message}}</small></span>
                      @enderror
                    </div>
                    <div class="float-right">
                        <button class="btn btn-warning btn-icon-split" wire:loading.remove>
                            <span class="icon text-white-50"><li class="fas fa-exclamation-triangle"></li></span>
                            <span class="text">Reset Password</span>
                        </button>
                        <div class="btn btn-warning btn-icon-split" style="cursor:wait" wire:loading wire:target="newPassword">
                            <span class="icon text-white-50"><li class="fas fa-info-circle"></li></span>
                            <span class="text">loading....</span>   
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        {{-- profile --}}
        <div class="card mb-4">
            <div class="card-header py-3">
                <div class="m-0 font-weight-bold text-primary">Profile picture</div>
                @if (session()->has('imgprofile'))                    
                    <div class="alert mt-3 mb-0 alert-success alert-dismissible fade show" role="alert">
                        {{ session('imgprofile') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
            <div class="card-body">
                @if ( isset($photo['profile']) )
                    @foreach ($typeData as $type)
                        @if ($photo['profile']->extension() == $type)
                        <img class="" style="display: block; margin-left: auto; margin-right: auto; width: 50%;" src="{{ $photo['profile']->temporaryUrl() }}" alt="profile-preview">
                        @endif
                    @endforeach
                @elseif( $userData->imgprofile )
                    <img class="" style="display: block; margin-left: auto; margin-right: auto; width: 50%;" src="{{asset('storage/'.$userData->imgprofile)}}" alt="profile-picture">
                @else
                    <img class="" style="display: block; margin-left: auto; margin-right: auto; width: 50%;" src="{{asset('tamplate/img/undraw_profile.svg')}}" alt="profile-picture">
                @endif
                @error('photo.profile')
                    <div class="text-center text-danger mt-2"><b>ERROR!! : </b><small>{{$message}}</small></div>
                @enderror
                <div class="text-center">
                    <div wire:loading wire:target="photo.profile" class="spinner-border text-primary text-center m-4" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <form wire:submit.prevent="saveProfile" class="mt-4" wire:loading.remove wire:target="photo.profile">
                    <div class="input-group mb-3">
                        <div class="custom-file">
                          <input type="file" wire:model="photo.profile" class="custom-file-input">
                          <label class="custom-file-label" for="inputGroupFile02">file</label>
                        </div>
                        <div class="input-group-append">
                        @isset($photo['profile']) <button type="submit" alt="save" class="btn btn-outline-primary"> <i class="far fa-save"></i> </button> @endisset
                        </div>
                    </div>
                </form>
            </div>
        </div>
        {{-- KTP --}}
        <div class="card mb-4">
            <div class="card-header py-3">
                <div class="m-0 font-weight-bold text-primary">KTP picture</div>
                @if (session()->has('imgktp'))                    
                    <div class="alert mt-3 mb-0 alert-success alert-dismissible fade show" role="alert">
                        {{ session('imgktp') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
            <div class="card-body">
                @if ( isset($photo['ktp']) )
                    @foreach ($typeData as $type)
                        @if ($photo['ktp']->extension() == $type)
                        <img class="" style="display: block; margin-left: auto; margin-right: auto; width: 50%;" src="{{ $photo['ktp']->temporaryUrl() }}" alt="profile-preview">
                        @endif
                    @endforeach
                @elseif( $userData->imgktp )
                    <img class="" style="display: block; margin-left: auto; margin-right: auto; width: 50%;" src="{{asset('storage/'.$userData->imgktp)}}" alt="profile-picture">
                @else
                    <img class="" style="display: block; margin-left: auto; margin-right: auto; width: 50%;" src="{{asset('tamplate/img/undraw_Hire_re_gn5j.svg')}}" alt="profile-picture">
                @endif
                @error('photo.ktp')
                    <div class="text-center text-danger mt-2"><b>ERROR!! : </b><small>{{$message}}</small></div>
                @enderror
                <div class="text-center">
                    <div wire:loading wire:target="photo.ktp" class="spinner-border text-primary text-center m-4" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <form wire:submit.prevent="saveKtp" class="mt-4" wire:loading.remove wire:target="photo.ktp">
                    <div class="input-group mb-3">
                        <div class="custom-file">
                          <input type="file" wire:model="photo.ktp" class="custom-file-input">
                          <label class="custom-file-label" for="inputGroupFile02">file</label>
                        </div>
                        <div class="input-group-append">
                        @isset($photo['ktp']) <button type="submit" alt="save" class="btn btn-outline-primary"> <i class="far fa-save"></i> </button> @endisset
                        </div>
                    </div>
                </form>
            </div>
        </div>
        {{-- npwp --}}
        <div class="card mb-4">
            <div class="card-header py-3">
                <div class="m-0 font-weight-bold text-primary">NPWP picture</div>
                @if (session()->has('imgnpwp'))                    
                    <div class="alert mt-3 mb-0 alert-success alert-dismissible fade show" role="alert">
                        {{ session('imgnpwp') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
            <div class="card-body">
                @if ( isset($photo['npwp']) )
                    @foreach ($typeData as $type)
                        @if ($photo['npwp']->extension() == $type)
                        <img class="" style="display: block; margin-left: auto; margin-right: auto; width: 50%;" src="{{ $photo['npwp']->temporaryUrl() }}" alt="profile-preview">
                        @endif
                    @endforeach
                @elseif( $userData->imgnpwp )
                    <img class="" style="display: block; margin-left: auto; margin-right: auto; width: 50%;" src="{{asset('storage/'.$userData->imgnpwp)}}" alt="profile-picture">
                @else
                    <img class="" style="display: block; margin-left: auto; margin-right: auto; width: 50%;" src="{{asset('tamplate/img/undraw_Credit_card_re_blml.svg')}}" alt="profile-picture">
                @endif
                @error('photo.npwp')
                    <div class="text-center text-danger mt-2"><b>ERROR!! : </b><small>{{$message}}</small></div>
                @enderror
                <div class="text-center">
                    <div wire:loading wire:target="photo.npwp" class="spinner-border text-primary text-center m-4" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <form wire:submit.prevent="saveNpwp" class="mt-4" wire:loading.remove wire:target="photo.npwp">
                    <div class="input-group mb-3">
                        <div class="custom-file">
                          <input type="file" wire:model="photo.npwp" class="custom-file-input">
                          <label class="custom-file-label" for="inputGroupFile02">file</label>
                        </div>
                        <div class="input-group-append">
                        @isset($photo['npwp']) <button type="submit" alt="save" class="btn btn-outline-primary"> <i class="far fa-save"></i> </button> @endisset
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

