<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Product;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('products', Product::class);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
