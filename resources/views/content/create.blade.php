@extends('layouts.app', ['title' => 'Group Manage', 'livewire' => true, 'tinymce' => true])

@section('content')
    <div class="row mb-4">
        @livewire('content.create-content', ['group' => $group])

        @if (auth()->user()->id == $group->user_id)
            @livewire('content.jurnalist-content', ['group' => $group])
        @endif
    </div>
@endsection