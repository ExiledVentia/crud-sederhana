<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;

Route::resource('/books', BookController::class);
Route::resource('/category', CategoryController::class);

Route::get('/', function () {
    return view('welcome');
});