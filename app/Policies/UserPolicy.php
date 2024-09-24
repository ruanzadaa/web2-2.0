<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }


    /**
     * Determine se o usuário pode alterar os privilégios de outro usuário.
     */
    public function updatePrivilege(User $user)
    {
        return $user->role === 'admin'; // Apenas administradores podem alterar privilégios
    }

    public function authorizeAll(User $user){
        return $user->role === 'admin' || $user->role === 'bibliotecario';
    }

    public function authorizeAdmin(User $user){
        return $user->role === 'admin';
    }

}
