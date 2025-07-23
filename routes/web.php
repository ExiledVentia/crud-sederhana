<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublisherController;

Route::resource('/books', BookController::class);
Route::resource('/category', CategoryController::class);
Route::resource('/publisher', PublisherController::class);

Route::get('/', function () {
    return view('welcome');
});