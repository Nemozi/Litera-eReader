<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;

Route::get('/', [ShowController::class, 'showAllBooks'])->name('home');

Route::get('upload', [UploadController::class, 'createForm'])->name('upload');
Route::post('upload', [UploadController::class, 'BookUpload'])->name('bookUpload');

Route::get('/home', [ShowController::class, 'showAllBooks'])->name('home');


require __DIR__.'/auth.php';

// Profile management routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::get('/read', [ShowController::class, 'readBook'])->name('readBook');
    Route::get('/book/{id}/edit', [BookController::class, 'edit'])->name('edit');
    Route::post('/book/{id}/update', [BookController::class, 'update'])->name('updateBook');
    Route::delete('/book/{id}/delete', [BookController::class, 'destroy'])->name('deleteBook');



    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

