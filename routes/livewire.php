<?php

use Illuminate\Support\Facades\Route;

// Auth::routes();

Route::get('/user/update-profile/{user}', UserProfile::class)->name('updateProfile')->middleware(['auth','my_account']);
Route::get('note/all/{group}', Group\Note\IndexNote::class)->name('noteAll')->middleware('auth', 'user_status', 'jurnalis');
