<?php

use Illuminate\Support\Facades\Route;

// route auth
Auth::routes();

Route::get('/', function () {
    return view('home');
})->middleware('auth');


// user handle 
Route::get('/user/list', 'EmployeController@index')->name('employesList');

Route::get('/home', 'HomeController@index')->name('home');

