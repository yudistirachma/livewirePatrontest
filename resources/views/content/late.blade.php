@extends('layouts.app', ['livewire' => true])

@section('content')

<div class="row">
    @livewire('tracking-content', ['query' => 'late'])
</div>

@endsection
