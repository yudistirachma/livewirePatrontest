@extends('layouts.app', ['title' => 'Note Detail', 'livewire' => true, 'tinymce' => true])

@section('content')
    @if (session()->has('status'))    
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @else
        
    @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <a href="{{ route('groupShow', $note->group_id) }}" class="badge badge-pill badge-secondary mr-2 align-middle" style="display: inline-block; height:100%;"><i class="fas fa-arrow-left"></i> Back</a>
                    <h6 class="m-0 font-weight-bold text-capitalize">{{ $note->user->name }} <small>( {{ $role }} )</small></h6>
                </div>
                <div class="d-flex">
                    @if (auth()->user()->id == $note->user_id)
                    <a href="{{ route('noteEdit', $note->id) }}" class="badge badge-pill badge-warning mr-2" style="display: inline-block; height:100%;">Edit</a>
                    <a href="{{ route('noteDelete', $note->id) }}" style="display: inline-block; height:100%;" class="badge badge-pill badge-danger">Delete</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            {{ $note->highlight }}
            <hr class="my-4">
            {!! $note->note !!}
        </div>
    </div>
@endsection