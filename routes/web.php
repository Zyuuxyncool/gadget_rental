<?php

use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\TransactionController;


// Dashboard Route
Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');

// Lokasi Api Route
Route::get('/api/get-lokasi', [\App\Http\Controllers\Api\LokasiController::class, 'getLokasi'])->name('api.get-lokasi');

// Transaction routes
Route::get('/transaction/export', [TransactionController::class, 'export'])->name('transaction.export');
Route::resource('/transaction', \App\Http\Controllers\TransactionController::class);
Route::post('transaction/search', [\App\Http\Controllers\TransactionController::class, 'search'])->name('search');
Route::post('/transaction/{id}/update-status', [\App\Http\Controllers\TransactionController::class, 'updateStatus']);

// Customer routes
Route::resource('/customer', \App\Http\Controllers\CustomerController::class);
Route::post('customer/search', [\App\Http\Controllers\CustomerController::class, 'search'])->name('search');

// Item routes
Route::resource('/item', \App\Http\Controllers\ItemController::class);
Route::post('item/search', [\App\Http\Controllers\ItemController::class, 'search'])->name('search');
