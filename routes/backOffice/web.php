<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\Admin\GreenSpaceController;
use App\Http\Controllers\ChatBotController;

Route::get('/admin', [DashboardController::class, 'home'])->name('back.home');
Route::get('/admin/users', [UsersController::class, 'index'])->name('back.users.index');


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
