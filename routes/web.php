<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\Admin\ProductController;

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

    // Route::resource('subcategories', SubcategoryController::class);
    // Display a form to create a new product
    Route::get('/create', [ProductController::class, 'create'])->name('products.create');

    Route::post('/getSubCategories', [ProductController::class, 'getSubCategories'])->name('getSubcategories');

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


Route::middleware(['auth', 'admin'])->prefix('categories')->group(function () {

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/{category}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/{category}/categories/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});


Route::middleware(['auth', 'admin'])->prefix('subcategories')->group(function () {

    Route::get('/', [SubcategoryController::class, 'index'])->name('subcategories.index');
    Route::get('/create/{category_id}', [SubcategoryController::class, 'create'])->name('subcategories.create');
    Route::post('/store', [SubcategoryController::class, 'store'])->name('subcategories.store');
    // Route::get('/{subcategory}', [SubcategoryController::class, 'show'])->name('subcategories.show');
    Route::get('/edit/{subcategory}', [SubcategoryController::class, 'edit'])->name('subcategories.edit');
    Route::put('/{subcategory}', [SubcategoryController::class, 'update'])->name('subcategories.update');
    Route::delete('/{subcategory}', [SubcategoryController::class, 'destroy'])->name('subcategories.destroy');
});

require __DIR__.'/auth.php';
