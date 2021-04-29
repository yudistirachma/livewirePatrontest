<?php

use Illuminate\Support\Facades\Route;

// route auth
Auth::routes();

Route::get('/', 'HomeController@index')->middleware('auth')->name('home');

// user handle 
Route::prefix('user')->middleware(['auth','role:pimpinan redaktur'])->group(function()
{
    Route::get('/', 'UserController@indexCreate')->name('employesList');
    Route::get('/{user}', 'UserController@index')->name('employeManage');
    Route::put('/{user}', 'UserController@update')->name('employeUpdate');
});

Route::prefix('group')->middleware('auth')->group(function () {
    // pimred
    Route::middleware('role:pimpinan redaktur')->group(function (){
        Route::get('/', 'GroupController@index')->name('listGroup');
        Route::get('/create', 'GroupController@create')->name('groupCreate');
        Route::get('/edit/{group}', 'GroupController@edit')->name('groupEdit');
    });

    // redaktur
    Route::get('/redaktur', 'GroupController@redaktur')->middleware('role:redaktur')->name('redakturGroup');
    
    // all
    Route::get('/my', 'GroupController@my')->name('myGroup');
    Route::get('/show/{group}', 'GroupController@show')->middleware('jurnalis')->name('groupShow');
    Route::get('/detail/{group}', 'GroupController@detail')->middleware('jurnalis')->name('groupDetail');
});

Route::prefix('content')->middleware('auth', 'jurnalis')->group(function () {
    Route::get('/create/{group}', 'ContentController@create')->name('contentCreate')->middleware('jurnalist_or_redaktur');
    Route::get('/edit/{content}', 'ContentController@edit')->name('contentEdit')->middleware('own_or_redaktur');
    Route::get('/show/{content}', 'ContentController@show')->name('contentShow')->middleware('own_or_redaktur');
});

Route::prefix('note')->middleware('auth', 'jurnalis')->group(function () {
    Route::get('/{note}', 'NoteController@show')->name('noteDetail');

    Route::middleware('pimred_or_redaktur')->group(function (){
        Route::get('/create/{group}', 'NoteController@create')->name('noteCreate');
        Route::post('/{group}', 'NoteController@post')->name('noteSave');

        Route::middleware('own')->group(function (){
            Route::get('delete/{note}', 'NoteController@destroy')->name('noteDelete');
            Route::get('/edit/{note}', 'NoteController@edit')->name('noteEdit');
            Route::put('/edit/{note}', 'NoteController@update')->name('noteUpdate');
        });
    });
});


Route::get('/home', 'HomeController@index')->middleware('auth');

