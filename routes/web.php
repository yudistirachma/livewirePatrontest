<?php

use Illuminate\Support\Facades\Route;

// route auth
Auth::routes();

Route::get('/', function () {
    return view('home');
})->middleware('auth');


// user handle 
Route::prefix('user')->middleware(['auth','role:pimpinan redaktur'])->group(function()
{
    Route::get('/', 'UserController@indexCreate')->name('employesList');
    Route::get('/{user}', 'UserController@index')->name('employeManage');
    Route::put('/{user}', 'UserController@update')->name('employeUpdate');
});

Route::prefix('group')->middleware('auth')->group(function () {
    // pimred
    Route::get('/', 'GroupController@index')->name('listGroup')->middleware('role:pimpinan redaktur');
    Route::get('/create', 'GroupController@create')->name('groupCreate');

    // redaktur
    Route::get('/redaktur', 'GroupController@redaktur')->middleware('role:redaktur')->name('redakturGroup');
    
    // all
    Route::get('/my', 'GroupController@my')->name('myGroup');
    Route::get('/show/{group}', 'GroupController@show')->middleware('auth')->name('groupShow');
});

Route::prefix('content')->middleware('auth')->group(function () {
    Route::get('/create', 'ContentController@create')->name('contentCreate');
    Route::put('/edit/{content}', 'ContentController@edit')->name('contentEdit');
});

Route::prefix('note')->middleware('auth')->group(function () {
    Route::get('/create/{group}', 'NoteController@create')->name('noteCreate');
    Route::put('/edit/{note}', 'NoteController@edit')->name('noteEdit');
    Route::post('/save/{group}', 'NoteController@post')->name('noteSave');
});


Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

