@extends('layouts.app', ['title' => 'User Manage', 'livewire' => true])

@section('content')
    <h1 class="h3 mb-2 text-gray-800">User Manage</h1>
    <p class="mb-1">manage Patron user employ and get best awesome inspiration</p>
    <ul class="nav justify-content-center mb-1">
        <li class="nav-item">
          <a class="nav-link text-secondary active" href="#">Create </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-secondary" href="#">Create</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-secondary" href="#">Create</a>
        </li>
    </ul>
    @livewire('user.user-list')
   

@endsection