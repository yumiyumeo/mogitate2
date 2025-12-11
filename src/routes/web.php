<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class,'index'])->name('products.index');
Route::get('/search', [ProductController::class,'search'])->name('products.search');
Route::resource('products', ProductController::class)->except(['show']);
