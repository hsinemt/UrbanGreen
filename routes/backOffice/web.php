<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CompetitionController;

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

// Projects Dashboard Routes
Route::prefix('admin')->group(function () {
    Route::get('projects', [ProjectController::class, 'dashboardIndex'])->name('back.projects.index');
    Route::get('projects/create', [ProjectController::class, 'dashboardCreate'])->name('back.projects.create');
    Route::post('projects', [ProjectController::class, 'dashboardStore'])->name('back.projects.store');
    Route::get('projects/{projet}', [ProjectController::class, 'dashboardShow'])->name('back.projects.show');
    Route::get('projects/{projet}/edit', [ProjectController::class, 'dashboardEdit'])->name('back.projects.edit');
    Route::put('projects/{projet}', [ProjectController::class, 'dashboardUpdate'])->name('back.projects.update');
    Route::delete('projects/{projet}', [ProjectController::class, 'dashboardDestroy'])->name('back.projects.destroy');
});

// Competitions Dashboard Routes
Route::prefix('admin')->group(function () {
    Route::get('competitions', [CompetitionController::class, 'dashboardIndex'])->name('back.competitions.index');
    Route::get('competitions/create', [CompetitionController::class, 'dashboardCreate'])->name('back.competitions.create');
    Route::post('competitions', [CompetitionController::class, 'dashboardStore'])->name('back.competitions.store');
    Route::get('competitions/{competition}', [CompetitionController::class, 'dashboardShow'])->name('back.competitions.show');
    Route::get('competitions/{competition}/edit', [CompetitionController::class, 'dashboardEdit'])->name('back.competitions.edit');
    Route::put('competitions/{competition}', [CompetitionController::class, 'dashboardUpdate'])->name('back.competitions.update');
    Route::delete('competitions/{competition}', [CompetitionController::class, 'dashboardDestroy'])->name('back.competitions.destroy');
});
