<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\BackOffice\ActivityController;
use App\Http\Controllers\BackOffice\EventController;

Route::get('/admin', [DashboardController::class, 'home'])->name('back.home');
Route::get('/admin/users', [UsersController::class, 'index'])->name('back.users.index');


Route::prefix('admin')->group(function () {
    Route::resource('resources', ResourceController::class);
});

Route::prefix('admin')->group(function () {
    Route::get('resources/{resource}/details', [ResourceController::class, 'details'])->name('resources.details');
    Route::resource('resources', ResourceController::class);
});

Route::prefix('admin')->group(function () {
    Route::get('users', [UsersController::class, 'index'])->name('back.users.index');
    Route::get('users/{id}', [UsersController::class, 'show'])->name('back.users.show');
    Route::put('users/{id}', [UsersController::class, 'update'])->name('back.users.update');
    Route::delete('users/{id}', [UsersController::class, 'destroy'])->name('back.users.destroy');
});

// Activities CRUD routes
Route::prefix('admin')->group(function () {
    Route::resource('activities', ActivityController::class)->names([
        'index' => 'back.activities.index',
        'create' => 'back.activities.create',
        'store' => 'back.activities.store',
        'show' => 'back.activities.show',
        'edit' => 'back.activities.edit',
        'update' => 'back.activities.update',
        'destroy' => 'back.activities.destroy',
    ]);
    Route::post('activities/bulk-delete', [ActivityController::class, 'bulkDelete'])->name('back.activities.bulk-delete');
});

// Events CRUD routes
Route::prefix('admin')->group(function () {
    Route::resource('events', EventController::class)->names([
        'index' => 'back.events.index',
        'create' => 'back.events.create',
        'store' => 'back.events.store',
        'show' => 'back.events.show',
        'edit' => 'back.events.edit',
        'update' => 'back.events.update',
        'destroy' => 'back.events.destroy',
    ]);
    Route::post('events/bulk-delete', [EventController::class, 'bulkDelete'])->name('back.events.bulk-delete');
    Route::post('events/{event}/remove-activity', [EventController::class, 'removeActivity'])->name('back.events.remove-activity');
});
