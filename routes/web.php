<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;

Route::get('/', [App\Http\Controllers\BookController::class, 'index'])->name('book.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\BookController::class, 'index'])->name('book.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\BookController::class, 'index'])->name('book.index');

Route::get('/dashboard', function () {return view('dashboard');})->middleware('auth');

// BOOKS

    // Show de Book
    Route::get('/libros/{id}/show',[BookController::class,'show'])->where('id','[0-9]+')->name('book.show');

    // Create y Store de Book
    Route::get('/libros/crear',[BookController::class,'create'])->name('book.crear');
    Route::post('/libros/crear',[BookController::class,'store'])->name('book.store');

    // Edit y Update de Book
    Route::get('/libros/{id}/editar',[BookController::class,'edit'])->whereNumber('id')->name('book.editar');
    Route::put('/libros/{id}/editar',[BookController::class,'update'])->whereNumber('id')->name('book.update');

    // Delete de Book
    Route::delete('/libros/{id}/borrar',[BookController::class,'destroy'])->whereNumber('id')->name('book.borrar');

// USERS

    // Perfil del Usuario que Tiene Iniciado Sesion
    Route::get('/perfil', [UserController::class, 'perfil'])->name('perfil');

    // Perfil del Usuario que Tiene Iniciado Sesion
    Route::get('/perfil/{id}', [UserController::class, 'show'])->name('user.show');

// RATINGS

    // Store de Rating
    Route::post('/ratings/crear', [UserController::class, 'store_rating'])->name('rating.store');

// MESSAGE

    // Store de Message
    Route::post('/user/{receiverId}/sendMessage', [UserController::class, 'store_message'])->name('message.store');