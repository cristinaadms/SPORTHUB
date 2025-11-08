<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function show(?User $user = null)
    {
        // Se não passar usuário, pega o logado
        $user = $user ?? Auth::user();

        $user = $user ?? Auth::user();

        // Contagem de partidas e partidas criadas
        $partidas = $user->partidas()->count();
        $organizadas = $user->partidasCriadas()->count();

        return view('perfil', compact('user', 'partidas', 'organizadas'));
    }

    public function edit()
    {
        $user = Auth::user();

        return view('perfil.editar', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user(); // usuário logado

        $dados = $request->validate([
            'name' => 'sometimes|string',
            'email' => 'sometimes|email|unique:users,email,'.$user->id,
            'telefone' => 'nullable|string|unique:users,telefone',
            'password' => 'nullable|min:6',
        ]);

        if (!empty($dados['password'])) {
            $dados['password'] = Hash::make($dados['password']);
        } else {
            unset($dados['password']); // não sobrescreve se estiver vazio
        }

        $user->update($dados);

        return redirect()->route('perfil')->with('success', 'Perfil atualizado com sucesso!');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['message' => 'Usuário removido com sucesso']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Invalida a sessão atual e o token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logout realizado com sucesso!');
    }
}
