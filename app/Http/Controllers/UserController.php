<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return User::all(); // listar todos
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'telefone' => 'nullable|string',
            'password' => 'required|min:6',
            'role' => 'in:user,admin',
        ]);

        $dados['password'] = Hash::make($dados['password']);

        return User::create($dados);
    }

    public function show(User $user)
    {
        return $user;
    }

    public function update(Request $request, User $user)
    {
        $dados = $request->validate([
            'name' => 'sometimes|string',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'telefone' => 'nullable|string',
            'password' => 'nullable|min:6',
            'role' => 'in:user,admin',
        ]);

        if (isset($dados['password'])) {
            $dados['password'] = Hash::make($dados['password']);
        }

        $user->update($dados);

        return $user;
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'Usuário removido com sucesso']);
    }
}
