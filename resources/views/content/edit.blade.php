@extends('layouts.app', ['title' => 'Group Manage', 'livewire' => true, 'tinymce' => true])

@section('content')
        @livewire('content.edit-content', ['content' => $content])
@endsection