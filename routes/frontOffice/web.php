<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

/*
|--------------------------------------------------------------------------
| FRONT OFFICE ROUTES
|--------------------------------------------------------------------------
*/

// Homepage
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
Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
// Backward-compatible link from old static page
Route::get('/projects/project-details', function () { return redirect()->route('projects.index'); });
Route::get('/projects/{projet}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/projects/{projet}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
Route::put('/projects/{projet}', [ProjectController::class, 'update'])->name('projects.update');
Route::delete('/projects/{projet}', [ProjectController::class, 'destroy'])->name('projects.destroy');

// Events
Route::get('/events/{slug}', function ($slug) {
    return view('frontOffice.pages.events.show', compact('slug'));
})->name('events.show');

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
