<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\ProductController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit')->permissions('profile.view');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update')->permissions('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy')->permissions('profile.delete');
});

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Roles & Permissions
    Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class)->except(['create', 'edit', 'show']);
    Route::get('permissions', [\App\Http\Controllers\Admin\PermissionController::class, 'index'])->name('permissions.index');

    // Brands
    Route::get('/brands', [BrandController::class, 'index'])->name('brands.index')->permissions('brands.view');
    Route::get('/brands/create', [BrandController::class, 'create'])->name('brands.create')->permissions('brands.create');
    Route::post('/brands', [BrandController::class, 'store'])->name('brands.store')->permissions('brands.create');
    Route::get('/brands/{brand}/edit', [BrandController::class, 'edit'])->name('brands.edit')->permissions('brands.edit');
    Route::put('/brands/{brand}', [BrandController::class, 'update'])->name('brands.update')->permissions('brands.edit');
    Route::delete('/brands/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy')->permissions('brands.delete');

    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index')->permissions('categories.view');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create')->permissions('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store')->permissions('categories.create');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit')->permissions('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update')->permissions('categories.edit');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy')->permissions('categories.delete');

    // Units
    Route::get('/units', [UnitController::class, 'index'])->name('units.index')->permissions('units.view');
    Route::get('/units/create', [UnitController::class, 'create'])->name('units.create')->permissions('units.create');
    Route::post('/units', [UnitController::class, 'store'])->name('units.store')->permissions('units.create');
    Route::get('/units/{unit}/edit', [UnitController::class, 'edit'])->name('units.edit')->permissions('units.edit');
    Route::put('/units/{unit}', [UnitController::class, 'update'])->name('units.update')->permissions('units.edit');
    Route::delete('/units/{unit}', [UnitController::class, 'destroy'])->name('units.destroy')->permissions('units.delete');

    // Products
    Route::get('/products', [ProductController::class, 'index'])->name('products.index')->permissions('products.view');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create')->permissions('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store')->permissions('products.create');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit')->permissions('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update')->permissions('products.edit');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy')->permissions('products.delete');
});

require __DIR__.'/auth.php';
