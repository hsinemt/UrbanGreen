<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ResourceController;

Route::get('/admin', [DashboardController::class, 'home'])->name('back.home');
Route::get('/admin/users', [UsersController::class, 'index'])->name('back.users.index');


Route::prefix('admin')->group(function () {
    Route::resource('resources', ResourceController::class);
});

Route::prefix('admin')->group(function () {
    Route::get('resources/{resource}/details', [ResourceController::class, 'details'])->name('resources.details');
    Route::resource('resources', ResourceController::class);
});
