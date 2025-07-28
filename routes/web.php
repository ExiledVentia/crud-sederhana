<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublisherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('publisher')->name('publisher.')->group(function () {
    Route::get('/trashed', [PublisherController::class, 'trashed'])->name('trashed');
    Route::put('/{id}/restore', [PublisherController::class, 'restore'])->name('restore');
    Route::delete('/{id}/force-delete', [PublisherController::class, 'forceDelete'])->name('forceDelete');
});

Route::prefix('category')->name('category.')->group(function () {
    Route::get('/trashed', [CategoryController::class, 'trashed'])->name('trashed');
    Route::put('/{id}/restore', [CategoryController::class, 'restore'])->name('restore');
    Route::delete('/{id}/force-delete', [CategoryController::class, 'forceDelete'])->name('forceDelete');
});

Route::resource('/books', BookController::class);
Route::resource('/category', CategoryController::class);
Route::resource('/publisher', PublisherController::class);  

Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/export/pdf', [BookController::class, 'exportPDF'])->name('books.export.pdf');
Route::get('/books/export/excel', [BookController::class, 'exportExcel'])->name('books.export.excel');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';