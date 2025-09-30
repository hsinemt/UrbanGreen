<?php

use Illuminate\Support\Facades\Route;

// Homepage
Route::get('/', function () { return view('pages.home'); })->name('home');

// Static pages
Route::get('/about', function () { return view('pages.about'); })->name('about');
Route::get('/contact', function () { return view('pages.contact'); })->name('contact');
Route::get('/gallery', function () { return view('pages.gallery'); })->name('gallery');
Route::get('/team', function () { return view('pages.team'); })->name('team');
Route::get('/cart', function () { return view('pages.cart'); })->name('cart');
Route::get('/wishlist', function () { return view('pages.wishlist'); })->name('wishlist');
Route::get('/checkout', function () { return view('pages.checkout'); })->name('checkout');
Route::get('/order-received', function () { return view('pages.order-received'); })->name('order.received');

// Blog
Route::get('/blog', function () { return view('pages.blog.index'); })->name('blog.index');
Route::get('/blog/{slug}', function () { return view('pages.blog.show'); })->name('blog.show');

// Products
Route::get('/products', function () { return view('pages.products.index'); })->name('products.index');
Route::get('/products/{slug}', function () { return view('pages.products.show'); })->name('products.show');

// Campaigns
Route::get('/campaigns', function () { return view('pages.campaigns.index'); })->name('campaigns.index');
Route::get('/campaigns/{slug}', function () { return view('pages.campaigns.show'); })->name('campaigns.show');

// Services
Route::get('/services', function () { return view('pages.services.index'); })->name('services.index');
Route::get('/services/{slug}', function () { return view('pages.services.show'); })->name('services.show');

// Projects
Route::get('/projects/{slug}', function () { return view('pages.projects.show'); })->name('projects.show');

// Events
Route::get('/events/{slug}', function () { return view('pages.events.show'); })->name('events.show');

// Causes
Route::get('/causes/agriculture', function () { return view('pages.causes.agriculture'); })->name('causes.agriculture');
Route::get('/causes/animal', function () { return view('pages.causes.animal'); })->name('causes.animal');
Route::get('/causes/charity', function () { return view('pages.causes.charity'); })->name('causes.charity');
Route::get('/causes/climate-change', function () { return view('pages.causes.climate-change'); })->name('causes.climate-change');
Route::get('/causes/ocean-life', function () { return view('pages.causes.ocean-life'); })->name('causes.ocean-life');
Route::get('/causes/recycling', function () { return view('pages.causes.recycling'); })->name('causes.recycling');
