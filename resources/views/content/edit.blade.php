@extends('layouts.app', ['title' => 'Content', 'livewire' => true, 'tinymce' => true])

@section('content')
        @livewire('content.edit-content', ['content' => $content])
@endsection