@extends('layouts.app', ['title' => 'Group Manage', 'livewire' => true, 'tinymce' => true])

@section('content')
    <div class="row">
        @livewire('content.create-content', ['group' => $group])
        @livewire('content.jurnalist-content', ['group' => $group])
    </div>
@endsection