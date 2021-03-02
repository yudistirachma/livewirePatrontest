@extends('layouts.app', ['title' => 'Group Manage', 'livewire' => true])

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Group Manage</h1>
    <p class="mb-2"></p>
    <div class="row">
        <div class="card shadow mb-4 mx-2 col-lg-8 p-0">
            <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary my-auto">Create group</h6></div>
            <div class="card-body pt-4">
                @livewire('group.create-group')
            </div>
        </div>
        @livewire('group.group-user-list')
    </div>
   

@endsection