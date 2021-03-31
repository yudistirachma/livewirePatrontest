@extends('layouts.app', ['title' => 'User Manage', 'livewire' => true])

@section('content')
    <div class="row" class="mb-3">

      <div class="col-lg">
        <h1 class="h3 mb-2 text-gray-800">User Manage</h1>
        <p >manage Patron user employ and get best awesome inspiration</p>
      </div>

      @if (session()->has("userManage"))
          <div class="alert alert-success col-lg my-auto mx-2">
            {!! session('userManage') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
      @endif

    </div>

    @livewire('user.user-list')
   

@endsection