<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BookPolicy
{
    public function create(User $user)
    {
        return $user->role === 'admin' || $user->role === 'bibliotecario';
    }

    public function update(User $user)
    {
        return $user->role === 'admin' || $user->role === 'bibliotecario';
    }
    
    public function delete(User $user, Book $book)
    {
        return $user->role === 'admin' || $user->role === 'bibliotecario';
    }

    public function up(User $user)
    {
        return $user->role === 'admin';
    }
}
