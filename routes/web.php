<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('task', [TaskController::class, 'index'])
    ->middleware(['auth', 'verified', 'checkRole:ROLE_ADMIN'])
    ->name('task');

Route::get('create-task', [TaskController::class, 'create'])
    ->middleware(['auth', 'verified', 'checkRole:ROLE_ADMIN'])
    ->name('create-task');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
