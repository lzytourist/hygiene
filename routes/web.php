<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebController::class, 'index'])->name('home');
Route::get('/products', [WebController::class, 'products'])->name('products');
Route::get('/product/{slug}', [WebController::class, 'product'])->name('product');

Route::get('/blog', [WebController::class, 'blog'])->name('blog.index');
Route::get('/blog/{slug}', [WebController::class, 'blogDetails'])->name('blog.details');

Route::resource('cart', CartController::class);

Route::get('/checkout', [WebController::class, 'checkout'])->name('checkout')->middleware(['auth', 'verified']);
Route::post('/place-order', [OrderController::class, 'store'])->name('order.place')->middleware(['auth', 'verified']);
Route::get('/order-confirmation/{order}', [WebController::class, 'orderConfirm'])->name('order.confirmation')->middleware(['auth', 'verified']);

Route::get('/dashboard', [WebController::class, 'orders'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/order-details/{order}', [WebController::class, 'order'])->middleware(['auth', 'verified'])->name('order-details');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);

        Route::delete('products/images/{image}', [ProductImageController::class, 'destroy'])->name('products.images.destroy');

        Route::resource('stocks', StockController::class);

        Route::resource('orders', OrderController::class);

        Route::resource('posts', PostController::class);

    });
