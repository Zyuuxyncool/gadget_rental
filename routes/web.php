<?php

use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LokasiController;

// Dashboard Route
Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');

// Lokasi Api Route
Route::get('/api/get-lokasi', [App\Http\Controllers\Api\LokasiController::class, 'getLokasi'])->name('api.get-lokasi');

// Transaction routes
Route::get('/transaction', [App\Http\Controllers\TransactionController::class, 'index'])->name('transaction.index');
Route::get('/transaction/create', [App\Http\Controllers\TransactionController::class, 'create'])->name('transaction.create');
Route::post('/transaction', [App\Http\Controllers\TransactionController::class, 'store'])->name('transaction.store');
Route::get('/transaction/{id}/edit', [App\Http\Controllers\TransactionController::class, 'edit'])->name('transaction.edit');
Route::put('/transaction/{id}', [App\Http\Controllers\TransactionController::class, 'update'])->name('transaction.update');
Route::delete('/transaction/{id}', [App\Http\Controllers\TransactionController::class, 'destroy'])->name('transaction.destroy');

// Customer routes
Route::get('/customer', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer.index');
Route::get('/customer/create', [App\Http\Controllers\CustomerController::class, 'create'])->name('customer.create');
Route::post('/customer', [App\Http\Controllers\CustomerController::class, 'store'])->name(('customer.store'));
Route::get(('/customer/{id}/edit'), [App\Http\Controllers\CustomerController::class, 'edit'])->name('customer.edit');
Route::put('/customer/{id}', [App\Http\Controllers\CustomerController::class, 'update'])->name(('customer.update'));
Route::delete('/customer/{id}', [App\Http\Controllers\CustomerController::class, 'destroy'])->name('customer.destroy');
Route::get('/customer/{id}/show', [App\Http\Controllers\CustomerController::class, 'show'])->name('customer.show');

// Item routes
Route::get('/item', [App\Http\Controllers\ItemController::class, 'index'])->name('item.index');
Route::get('/item/create', [App\Http\Controllers\ItemController::class, 'create'])->name('item.create');
Route::post('/item', [App\Http\Controllers\ItemController::class, 'store'])->name('item.store');
Route::get('/item/{id}/edit', [App\Http\Controllers\ItemController::class, 'edit'])->name('item.edit');
Route::put('/item/{id}', [App\Http\Controllers\ItemController::class, 'update'])->name('item.update');
Route::delete('/item/{id}', [App\Http\Controllers\ItemController::class, 'destroy'])->name('item.destroy');





// Transaction routes
Route::get('/transaction', [App\Http\Controllers\TransactionController::class, 'index'])->name('transaction.index');
Route::get('/transaction/create', [App\Http\Controllers\TransactionController::class, 'create'])->name('transaction.create');
Route::post('/transaction', [App\Http\Controllers\TransactionController::class, 'store'])->name('transaction.store');
Route::get('/transaction/{id}/edit', [App\Http\Controllers\TransactionController::class, 'edit'])->name('transaction.edit');
Route::put('/transaction/{id}', [App\Http\Controllers\TransactionController::class, 'update'])->name('transaction.update');
Route::delete('/transaction/{id}', [App\Http\Controllers\TransactionController::class, 'destroy'])->name('transaction.destroy');

// Customer routes
Route::get('/customer', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer.index');
Route::get('/customer/create', [App\Http\Controllers\CustomerController::class, 'create'])->name('customer.create');
Route::post('/customer', [App\Http\Controllers\CustomerController::class, 'store'])->name(('customer.store'));
Route::get(('/customer/{id}/edit'), [App\Http\Controllers\CustomerController::class, 'edit'])->name('customer.edit');
Route::put('/customer/{id}', [App\Http\Controllers\CustomerController::class, 'update'])->name(('customer.update'));
Route::delete('/customer/{id}', [App\Http\Controllers\CustomerController::class, 'destroy'])->name('customer.destroy');
Route::get('/customer/{id}/show', [App\Http\Controllers\CustomerController::class, 'show'])->name('customer.show');

// Item routes
Route::get('/item', [App\Http\Controllers\ItemController::class, 'index'])->name('item.index');
Route::get('/item/create', [App\Http\Controllers\ItemController::class, 'create'])->name('item.create');
Route::post('/item', [App\Http\Controllers\ItemController::class, 'store'])->name('item.store');
Route::get('/item/{id}/edit', [App\Http\Controllers\ItemController::class, 'edit'])->name('item.edit');
Route::put('/item/{id}', [App\Http\Controllers\ItemController::class, 'update'])->name('item.update');
Route::delete('/item/{id}', [App\Http\Controllers\ItemController::class, 'destroy'])->name('item.destroy');
