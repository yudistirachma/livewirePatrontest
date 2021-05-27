@extends('layouts.app', ['livewire' => true])

@section('content')

<div class="row">
    @livewire('tracking-content', ['query' => 'validated'])
</div>

@endsection
