<?php

use Illuminate\Support\Facades\Route;

// route auth
Auth::routes();

Route::get('/', function () {
    return view('home');
})->middleware('auth');


// user handle 
Route::get('/user/manage', 'UserController@index')->name('employesList')->middleware('auth');

Route::get('group', 'GroupController@index')->name('group')->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

