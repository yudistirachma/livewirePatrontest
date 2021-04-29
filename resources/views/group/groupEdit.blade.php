@extends('layouts.app', ['title' => 'Group Manage', 'livewire' => true])

@section('content')
    <div class="row">
        <div class="card shadow mb-4 mx-2 col-lg-8 p-0">
            <div class="card-header py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <a href="http://localhost:8000/group/show/1" class="badge badge-pill badge-secondary mr-2 align-middle" style="display: inline-block; height:100%;"><i class="fas fa-arrow-left"></i> Back</a>
                    <h6 class="m-0 font-weight-bold text-primary my-auto">Edit group</h6>
                </div>
            </div>
            <div class="card-body pt-4">
                @livewire('group.edit-group', ['group' => $group])
            </div>
        </div>
        @livewire('group.group-user-list', ['users' => $group->users->toArray()])
    </div>
@endsection