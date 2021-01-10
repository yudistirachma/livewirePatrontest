<?php

use Illuminate\Support\Facades\Route;

Route::get('/user/update-profile/{id}', UserProfile::class)->name('updateProfile');