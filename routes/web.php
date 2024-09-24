<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\UserController;


// Rotas para Books
Route::resource('books', BookController::class);

// Rotas para Authors
Route::resource('authors', AuthorController::class);

// Rotas para Categories
Route::resource('categories', CategoryController::class);

// Rotas para Publishers
Route::resource('publishers', PublisherController::class);

Route::get('/', function () {
    return view('auth/login');
});
Auth::routes();



// routes/web.php


Route::get('/users/{id}/editPrivilege', [UserController::class, 'editPrivilege'])->name('users.editPrivilege');
Route::post('/users/{id}/updatePrivilege', [UserController::class, 'updatePrivilege'])->name('users.updatePrivilege');

// routes/web.php




Route::get('/users', [UserController::class, 'index'])->name('users.index');




