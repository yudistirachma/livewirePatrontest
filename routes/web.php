<?php

use Illuminate\Support\Facades\Route;

// route auth
Auth::routes();

Route::get('/', function () {
    return view('home');
})->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home');

