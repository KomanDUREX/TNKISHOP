<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ShopController::class, 'index'])->name('home');
Route::get('/products', [ShopController::class, 'products'])->name('products');
Route::get('/catalog', [ShopController::class, 'catalog'])->name('catalog');
Route::get('/favorites', [ShopController::class, 'favorites'])->name('favorites')->middleware('auth');
Route::get('/cart', [ShopController::class, 'cart'])->name('cart');
Route::get('/about', [ShopController::class, 'about'])->name('about');
Route::get('/contacts', [ShopController::class, 'contacts'])->name('contacts');

Route::post('/cart/add/{id}', [ShopController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update/{id}', [ShopController::class, 'updateCartQuantity'])->name('cart.update');
Route::post('/cart/remove/{id}', [ShopController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/checkout', [ShopController::class, 'checkout'])->name('cart.checkout');
Route::post('/favorites/add/{id}', [ShopController::class, 'addToFavorites'])->name('favorites.add')->middleware('auth');
Route::post('/favorites/remove/{id}', [ShopController::class, 'removeFromFavorites'])->name('favorites.remove')->middleware('auth');
Route::post('/favorites/clear', [ShopController::class, 'clearFavorites'])->name('favorites.clear')->middleware('auth');
Route::post('/contact/send', [ShopController::class, 'sendContact'])->name('contact.send');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('filters', \App\Http\Controllers\Admin\FilterController::class);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->only(['index', 'update']);
});
