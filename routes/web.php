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
    return view('welcome');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/create', [BookController::class, 'create'])->name('books.create'); // Formulário de criação
Route::post('/books', [BookController::class, 'store'])->name('books.store');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show'); // Ver
Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit'); // Editar
Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update'); // Atualizar
Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy'); // Excluir

// routes/web.php


Route::get('/users/{id}/editPrivilege', [UserController::class, 'editPrivilege'])->name('users.editPrivilege');
Route::post('/users/{id}/updatePrivilege', [UserController::class, 'updatePrivilege'])->name('users.updatePrivilege');

// routes/web.php




Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::middleware('admin')->get('/test-admin', function () {
    return 'Acesso permitido para admin!';
});


