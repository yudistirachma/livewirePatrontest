<div class="row">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header py-3">
                <div class="m-0 font-weight-bold text-primary">Personal data information</div>
            </div>
            <div class="card-body">
                <h1>{{$data}}</h1>
                <form>
                    <div class="form-group">
                      <label for="name">Name</label>
                      {{-- {{$data['aing'] }} --}}
                      <input type="text" class="form-control" id="name" name="name" value="{{$data}}">
                      {{-- {{dd($data['name'])}} --}}
                    </div>
                    {{-- <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" id="email" name="email" value="{{$data['email']}}" placeholder="aku@email.com">
                    </div>
                    <div class="form-group">
                      <label for="phoneNumber">Phone number</label>
                      <input type="num" class="form-control" id="phoneNumber" value="{{$data['phoneNum']}}" name="phoneNum">
                    </div>
                    <div class="form-group">
                      <label for="ktp">KTP (kartu tanda penduduk)</label>
                      <input type="num" class="form-control" id="ktp" name="ktp" value="{{$data['ktp']}}">
                    </div>
                    <div class="form-group">
                      <label for="npwp">npwp (nomor pokok wajib pajak)</label>
                      <input type="num" class="form-control" id="npwp" name="npwp" value="{{$data['npwp']}}">
                    </div> --}}
                    <div class="float-right">
                        <button class="btn btn-primary btn-icon-split">
                            <span class="icon text-white-50"><li class="fas fa-check"></li></span>
                            <span class="text">Save</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-header py-3">
                <div class="m-0 font-weight-bold text-primary">Profile picture</div>
            </div>
            <div class="card-body">
                <img class="" style="display: block; margin-left: auto; margin-right: auto; width: 50%;" src="{{asset('tamplate/img/undraw_secure_login_pdn4.svg')}}" alt="profile-picture">
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header py-3">
                <div class="m-0 font-weight-bold text-primary">KTP picture</div>
            </div>
            <div class="card-body">
                <img class="" style="display: block; margin-left: auto; margin-right: auto; width: 50%;" src="{{asset('tamplate/img/undraw_profile_2.svg')}}" alt="profile-picture">
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header py-3">
                <div class="m-0 font-weight-bold text-primary">NPWP picture</div>
            </div>
            <div class="card-body">
                <img class="" style="display: block; margin-left: auto; margin-right: auto; width: 50%;" src="{{asset('tamplate/img/undraw_profile_2.svg')}}" alt="profile-picture">
            </div>
        </div>
    </div>
</div>

