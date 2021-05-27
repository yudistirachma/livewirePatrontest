@extends('layouts.app', ['livewire' => true, 'title' => 'On Going Content'])

@section('content')

<div class="row">
    @livewire('tracking-content', ['query' => 'onGoing'])
</div>

@endsection
