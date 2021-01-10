<?php

use Illuminate\Support\Facades\Route;

// route auth
Auth::routes();

Route::get('/', function () {
    return view('home');
})->middleware('auth');

// route controller laravel handle
route::namespace('App\Http\Controllers')->group(function()
{
    Route::get('/home', 'HomeController@index')->name('home');
});

// route controller livewire handle
// Route::get('/user/update-profile/{id}', \App\Http\Livewire\UserProfile::class)->name('updateProfile');

