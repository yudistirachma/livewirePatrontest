<?php

use Illuminate\Support\Facades\Route;

// Auth::routes();

Route::get('/user/update-profile/{user}', UserProfile::class)->name('updateProfile')->middleware(['auth','my_account']);
