<?php

use Illuminate\Support\Facades\Route;

Route::get('/user/update-profile/{user}', UserProfile::class)->name('updateProfile');
