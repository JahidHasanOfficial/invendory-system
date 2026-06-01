<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

    // Brands
    Route::get('/brands', [\App\Http\Controllers\Admin\BrandController::class, 'index'])->name('brands.index')->permissions('brands.view');
    Route::get('/brands/create', [\App\Http\Controllers\Admin\BrandController::class, 'create'])->name('brands.create')->permissions('brands.create');
    Route::post('/brands', [\App\Http\Controllers\Admin\BrandController::class, 'store'])->name('brands.store')->permissions('brands.create');
    Route::get('/brands/{brand}/edit', [\App\Http\Controllers\Admin\BrandController::class, 'edit'])->name('brands.edit')->permissions('brands.edit');
    Route::put('/brands/{brand}', [\App\Http\Controllers\Admin\BrandController::class, 'update'])->name('brands.update')->permissions('brands.edit');
    Route::delete('/brands/{brand}', [\App\Http\Controllers\Admin\BrandController::class, 'destroy'])->name('brands.destroy')->permissions('brands.delete');
});

require __DIR__.'/auth.php';
