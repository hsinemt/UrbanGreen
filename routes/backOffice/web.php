<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;

Route::get('/admin', [DashboardController::class, 'home'])->name('back.home');
Route::get('/admin/users', [UsersController::class, 'index'])->name('back.users.index');
