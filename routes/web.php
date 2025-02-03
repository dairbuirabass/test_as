<?php

use App\Http\Controllers\ProductPriceController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductPriceController::class, 'index']);
Route::post('/calculate', [ProductPriceController::class, 'calculate'])->name('calculate');
