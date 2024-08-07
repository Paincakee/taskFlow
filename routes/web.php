<?php

use App\Http\Controllers\TaskController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('task', [TaskController::class, 'index'])
    ->middleware(['auth', 'verified', 'checkRole:ROLE_ADMIN'])
    ->name('task');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
