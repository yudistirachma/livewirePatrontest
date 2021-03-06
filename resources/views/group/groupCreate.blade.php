@extends('layouts.app', ['title' => 'Create Group', 'livewire' => true])

@section('content')
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