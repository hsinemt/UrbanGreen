<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\GreenSpaceController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ChatBotController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\DonationController;

// Home
Route::get('/', function () {
    return view('frontOffice.pages.home');
})->name('home');

// Static Pages
Route::get('/about', function () {
    return view('frontOffice.pages.about');
})->name('about');

Route::get('/contact', function () {
    return view('frontOffice.pages.contact');
})->name('contact');

Route::get('/gallery', function () {
    return view('frontOffice.pages.gallery');
})->name('gallery');

Route::get('/team', function () {
    return view('frontOffice.pages.team');
})->name('team');

// Currency Exchange Routes
Route::get('/currency', [CurrencyController::class, 'index'])->name('currency.index');
Route::post('/currency/convert', [CurrencyController::class, 'convert'])->name('currency.convert');
Route::get('/currency/rates', [CurrencyController::class, 'getRates'])->name('currency.rates');
Route::get('/currency/rate', [CurrencyController::class, 'getRate'])->name('currency.rate');

Route::get('/cart', function () {
    return view('frontOffice.pages.cart');
})->name('cart');

Route::get('/wishlist', function () {
    return view('frontOffice.pages.wishlist');
})->name('wishlist');

Route::get('/checkout', function () {
    return view('frontOffice.pages.checkout');
})->name('checkout');

Route::get('/order-received', function () {
    return view('frontOffice.pages.order-received');
})->name('order.received');

// Blog
Route::get('/blog', function () {
    return view('frontOffice.pages.blog.index');
})->name('blog.index');

Route::get('/blog/{slug}', function ($slug) {
    return view('frontOffice.pages.blog.show', compact('slug'));
})->name('blog.show');

// Products
Route::get('/products', function () {
    return view('frontOffice.pages.products.index');
})->name('products.index');

Route::get('/products/{slug}', function ($slug) {
    return view('frontOffice.pages.products.show', compact('slug'));
})->name('products.show');

// Campaigns
Route::get('/campaigns', function () {
    return view('frontOffice.pages.campaigns.index');
})->name('campaigns.index');

Route::get('/campaigns/{slug}', function ($slug) {
    return view('frontOffice.pages.campaigns.show', compact('slug'));
})->name('campaigns.show');

// Services
Route::get('/services', function () {
    return view('frontOffice.pages.services.index');
})->name('services.index');

Route::get('/services/{slug}', function ($slug) {
    return view('frontOffice.pages.services.show', compact('slug'));
})->name('services.show');

// Projects (CRUD)
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/all', function () {
    $projects = \App\Models\Projet::latest()->with('user')->get();
    $stats = [
        'total' => \App\Models\Projet::count(),
        'by_status' => \App\Models\Projet::selectRaw('status, COUNT(*) as count')->groupBy('status')->pluck('count', 'status')->toArray(),
        'total_budget' => \App\Models\Projet::sum('budget'),
        'avg_progress' => \App\Models\Projet::avg('progress_percentage'),
        'completed_count' => \App\Models\Projet::where('status', 'completed')->count(),
        'in_progress_count' => \App\Models\Projet::where('status', 'in_progress')->count(),
    ];
    return view('frontOffice.pages.projects.show', compact('projects', 'stats'));
})->name('projects.all');

Route::middleware('auth')->group(function () {
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{projet}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{projet}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{projet}', [ProjectController::class, 'destroy'])->name('projects.destroy');
});

Route::get('/projects/project-details', function () {
    return redirect()->route('projects.index');
});
Route::get('/projects/{projet}', [ProjectController::class, 'show'])->name('projects.show');

// Causes
Route::get('/causes/agriculture', function () {
    return view('frontOffice.pages.causes.agriculture');
})->name('causes.agriculture');

Route::get('/causes/animal', function () {
    return view('frontOffice.pages.causes.animal');
})->name('causes.animal');

Route::get('/causes/charity', function () {
    return view('frontOffice.pages.causes.charity');
})->name('causes.charity');

Route::get('/causes/climate-change', function () {
    return view('frontOffice.pages.causes.climate-change');
})->name('causes.climate-change');

Route::get('/causes/ocean-life', function () {
    return view('frontOffice.pages.causes.ocean-life');
})->name('causes.ocean-life');

Route::get('/causes/recycling', function () {
    return view('frontOffice.pages.causes.recycling');
})->name('causes.recycling');

// Donations CRUD
Route::resource('donations', App\Http\Controllers\DonationController::class);
// Stripe Checkout routes
Route::post('/donations/checkout', [DonationController::class, 'checkout'])->name('donations.stripe.checkout');
Route::get('/donations/stripe/success', [DonationController::class, 'success'])->name('donations.stripe.success');
Route::get('/donations/stripe/cancel', [DonationController::class, 'cancel'])->name('donations.stripe.cancel');
// Events Resource Routes
Route::resource('events', EventController::class);
Route::post('events/bulk-delete', [EventController::class, 'bulkDelete'])->name('events.bulk-delete');
Route::get('events/search/live', [EventController::class, 'search'])->name('events.search');
Route::post('events/{id}/assign-activity', [App\Http\Controllers\EventController::class, 'assignActivity'])->name('events.assign-activity');
Route::delete('events/{id}/remove-activity', [App\Http\Controllers\EventController::class, 'removeActivity'])->name('events.remove-activity');

// Activities Resource Routes
use App\Http\Controllers\ActivityController;
Route::resource('activities', App\Http\Controllers\ActivityController::class);
Route::post('activities/bulk-delete', [App\Http\Controllers\ActivityController::class, 'bulkDelete'])->name('activities.bulk-delete');
Route::get('activities/search/live', [App\Http\Controllers\ActivityController::class, 'search'])->name('activities.search');
// GreenSpaces CRUD page (UI)
// ==================== FEEDBACK ROUTES ====================

// Public feedback routes (no authentication required)
Route::get('events/{event}/feedback', [FeedbackController::class, 'show'])->name('feedback.show');
Route::get('api/events/{event}/feedback', [FeedbackController::class, 'index'])->name('feedback.index');

// Protected feedback routes (authentication required)
Route::middleware(['auth'])->group(function () {
    // Create feedback (comment with rating or reply)
    Route::post('events/{event}/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

    // Update feedback (only owner can update)
    Route::put('feedback/{feedback}', [FeedbackController::class, 'update'])->name('feedback.update');

    // Delete feedback (owner or admin can delete)
    Route::delete('feedback/{feedback}', [FeedbackController::class, 'destroy'])->name('feedback.destroy');

    // Like/Unlike feedback
    Route::post('feedback/{feedback}/like', [FeedbackController::class, 'like'])->name('feedback.like');
    Route::post('feedback/{feedback}/unlike', [FeedbackController::class, 'unlike'])->name('feedback.unlike');

    // Report inappropriate feedback
    Route::post('feedback/{feedback}/report', [FeedbackController::class, 'report'])->name('feedback.report');
});

// GreenSpaces
Route::get('/greenspaces', function () {
    return view('frontOffice.pages.greenspaces');
})->name('greenspaces.page');

Route::get('/green-spaces', [GreenSpaceController::class, 'index']);
Route::post('/green-spaces', [GreenSpaceController::class, 'store']);
Route::get('/green-spaces/{id}', [GreenSpaceController::class, 'show']);
Route::put('/green-spaces/{id}', [GreenSpaceController::class, 'update']);
Route::delete('/green-spaces/{id}', [GreenSpaceController::class, 'destroy']);
Route::post('/green-spaces/{id}/book', [GreenSpaceController::class, 'book']);

// Plants CRUD page (UI)
Route::get('/plants-page', function () {
    return view('frontOffice.pages.plants');
})->name('plants.page');

Route::get('/plants', [App\Http\Controllers\PlantController::class, 'index']);
Route::post('/plants', [App\Http\Controllers\PlantController::class, 'store']);
Route::get('/plants/{plant}', [App\Http\Controllers\PlantController::class, 'show']);
Route::put('/plants/{plant}', [App\Http\Controllers\PlantController::class, 'update']);
Route::delete('/plants/{plant}', [App\Http\Controllers\PlantController::class, 'destroy']);

// Authentication Routes
Route::post('/register', [UsersController::class, 'register'])->name('register');
Route::post('/login', [UsersController::class, 'login'])->name('login');
Route::post('/logout', [UsersController::class, 'logout'])->name('logout');

// Authenticated User Routes
// ChatBot IA pour les clients
Route::get('/assistant-ia', [ChatBotController::class, 'frontIndex'])->name('chatbot.front.index');
Route::post('/assistant-ia/send', [ChatBotController::class, 'sendMessage'])->name('chatbot.front.send');
Route::get('/assistant-ia/history', [ChatBotController::class, 'getHistory'])->name('chatbot.front.history');
Route::get('/assistant-ia/api-info', [ChatBotController::class, 'getApiInfo'])->name('chatbot.front.api-info');

Route::middleware(['auth'])->group(function () {
    // User Profile
    Route::get('/profile', [UsersController::class, 'userProfile'])->name('user.profile');
    Route::put('/profile', [UsersController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/avatar', [UsersController::class, 'updateAvatar'])->name('profile.avatar');
});

// Supplier-Only Routes - Protected by auth middleware
Route::middleware(['auth'])->group(function () {
    // Add resource to event (Show form)
    Route::get('events/{event}/add-resource', [ResourceController::class, 'addToEvent'])
        ->name('resources.add-to-event');

    // Store resource to event
    Route::post('events/{event}/add-resource', [ResourceController::class, 'storeToEvent'])
        ->name('resources.store-to-event');

    // Edit supplier's own resource
    Route::get('resources/{resource}/edit', [ResourceController::class, 'editSupplier'])
        ->name('resources.edit-supplier');

    // Update supplier's own resource
    Route::put('resources/{resource}', [ResourceController::class, 'updateSupplier'])
        ->name('resources.update-supplier');

    // Delete supplier's own resource
    Route::delete('resources/{resource}', [ResourceController::class, 'destroySupplier'])
        ->name('resources.destroy-supplier');

    // Get event resources as JSON
    Route::get('events/{event}/resources', [ResourceController::class, 'getEventResources'])
        ->name('resources.event-resources');
});





