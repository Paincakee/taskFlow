<?php

use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('task', 'task')
    ->middleware(['auth', 'verified', 'checkRole:ROLE_ADMIN'])
    ->name('task');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
