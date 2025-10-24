<?php

use App\Http\Controllers\Admin\GreenSpaceController;
use App\Http\Controllers\Admin\WalletController;
use App\Http\Controllers\BackOffice\ActivityController;
use App\Http\Controllers\BackOffice\EventController;
use App\Http\Controllers\ChatBotController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/admin', [DashboardController::class, 'home'])->name('back.home');
Route::get('/admin/users', [UsersController::class, 'index'])->name('back.users.index');
Route::get('/admin/feedback', [FeedbackController::class, 'adminIndex'])->name('back.feedback.index');
Route::get('/admin/feedback/download-pdf', [FeedbackController::class, 'downloadPdf'])->name('back.feedback.download-pdf');

Route::prefix('admin')->group(function () {
    Route::resource('resource', ResourceController::class);
});

Route::prefix('admin')->group(function () {
    Route::get('resource/{resource}/details', [ResourceController::class, 'details'])->name('resource.details');
    Route::resource('resource', ResourceController::class);
});

Route::prefix('admin')->group(function () {
    Route::get('users', [UsersController::class, 'index'])->name('back.users.index');
    Route::get('users/{id}', [UsersController::class, 'show'])->name('back.users.show');
    Route::put('users/{id}', [UsersController::class, 'update'])->name('back.users.update');
    Route::delete('users/{id}', [UsersController::class, 'destroy'])->name('back.users.destroy');
});

// Routes pour les Green Spaces (Admin)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('green-spaces', GreenSpaceController::class);
});

// Routes pour les Plantes (Admin)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('plants', PlantController::class);
});

// Routes pour le ChatBot IA (Admin)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('chatbot', [ChatBotController::class, 'index'])->name('chatbot.index');
    Route::post('chatbot/send', [ChatBotController::class, 'sendMessage'])->name('chatbot.send');
    Route::get('chatbot/history', [ChatBotController::class, 'getHistory'])->name('chatbot.history');
});

// Routes pour les Wallets (CRUD Admin)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('wallets', WalletController::class);
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
