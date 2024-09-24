<?php

// app/Http/Controllers/UserController.php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Lista todos os usuários
    public function index()
    {
        $this->authorize('updatePrivilege', User::class);

        $users = User::all();  // Lista todos os usuários do sistema
        return view('users.index', compact('users'));
        
    }

    // Exibe o formulário de edição de privilégio
    public function editPrivilege($id)
    {
        $this->authorize('updatePrivilege', User::class);
        $user = User::findOrFail($id);  // Busca o usuário pelo ID
        return view('users.editPrivilege', compact('user'));
    }

    // Atualiza o privilégio do usuário
    public function updatePrivilege(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Valida o novo privilégio
        $request->validate([
            'role' => 'required|in:user,admin,bibliotecario',
        ]);

        // Atualiza o campo 'role' com o novo privilégio
        $this->authorize('updatePrivilege', User::class);

        $user->role = $request->input('role');
        $user->save();

        return redirect()->route('users.index')->with('success', 'Privilégio do usuário atualizado com sucesso.');
    }
}
