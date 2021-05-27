<?php

use Illuminate\Support\Facades\Route;

// route auth
Auth::routes();

Route::get('/', 'HomeController@index')->middleware('auth', 'user_status')->name('home');

// user handle 
Route::prefix('user')->middleware(['auth', 'user_status','role:pimpinan redaktur'])->group(function()
{
    Route::get('/', 'UserController@indexCreate')->name('employesList');
    Route::get('/{user}', 'UserController@index')->name('employeManage');
    Route::put('/{user}', 'UserController@update')->name('employeUpdate');
});

Route::prefix('group')->middleware('auth', 'user_status')->group(function () {
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

Route::prefix('content')->middleware('auth', 'user_status')->group(function() {
    Route::get('/on-going', 'ContentController@onGoing')->name('contentOnGoing');
    Route::get('/late', 'ContentController@late')->name('contentLate');
    Route::get('/validated', 'ContentController@validated')->name('contentValidated');
    Route::get('/all', 'ContentController@all')->name('contentAll');
});

Route::prefix('content')->middleware('auth', 'user_status', 'jurnalis')->group(function () {
    Route::get('/create/{group}', 'ContentController@create')->name('contentCreate')->middleware('jurnalist_or_redaktur');
    Route::get('/edit/{content}', 'ContentController@edit')->name('contentEdit')->middleware('own_or_redaktur');
    Route::get('/show/{content}', 'ContentController@show')->name('contentShow')->middleware('own_or_redaktur');
});

Route::prefix('note')->middleware('auth', 'user_status', 'jurnalis')->group(function () {
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


Route::get('/home', 'HomeController@index')->middleware('auth', 'user_status');

