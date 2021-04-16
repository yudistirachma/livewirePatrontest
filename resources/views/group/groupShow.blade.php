@extends('layouts.app', ['title' => 'Group', 'livewire' => true])

@section('content')
    <div class="card mb-3 shadow">
        <div class="card-body">        
            <div class="row">
                <img class="col-lg-3 mb-2" src="{{ asset('tamplate/img/undraw_typewriter_i8xd.svg') }}" style="height:100%;">
                <div class="col-lg-9">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title text-capitalize font-weight-bold">{{ $group->segment }}</h4>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                <div class="dropdown-header">Group menu :</div>
                                <a class="dropdown-item" href="#">Detail</a>
                                @if (auth()->user()->id == $group->user_id  or auth()->user()->roles[0]->name == 'pimpinan redaktur')
                                    @if (auth()->user()->roles[0]->name == 'pimpinan redaktur')
                                    <a class="dropdown-item" href="#">Edit</a>
                                    @endif
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('noteCreate', $group->id) }}">Add note</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <p class="card-text">{{ $group->desc }}</p>
                    <p class="card-text"><small class="text-muted">Updated : <span class="font-weight-bold" >{{ $group->updated_at->diffForHumans() }}</span> | Created : <span class="font-weight-bold">{{ $group->created_at->toDateString() }}</span></small></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @livewire('group.note.note-group', ['data' => $group])
        @livewire('group.content.content-group', ['data' => $group])
    </div>
    
@endsection