<?php

use Illuminate\Support\Facades\Route;

Route::get('/lokasi/{parent_id?}', [\App\Http\Controllers\Api\LokasiController::class, 'index']);