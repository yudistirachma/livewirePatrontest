@extends('layouts.app')

@section('content')
    {{Auth::user()->name }}
@endsection