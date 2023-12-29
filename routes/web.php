<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('products')->group(function () {
    // Display a form to create a new product
    Route::get('/create', [ProductController::class, 'create'])->name('products.create');

    // Store a new product in the database
    Route::post('/store', [ProductController::class, 'store'])->name('products.store');

    // Display a list of products
    Route::get('/index', [ProductController::class, 'index'])->name('products.index');

    // Display a specific product
    Route::get('/{product}', [ProductController::class, 'show'])->name('products.show');

    // Display a form to edit a specific product
    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');

    // Update a specific product in the database
    Route::put('/{product}', [ProductController::class, 'update'])->name('products.update');

    // Delete a specific product from the database
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});

require __DIR__.'/auth.php';
