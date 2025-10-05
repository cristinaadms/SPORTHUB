<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, \Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Você precisa estar logado para acessar esta página.');
        }

        if (Auth::user()->role !== 'admin') {
            abort(403, 'Acesso negado. Somente administradores podem acessar esta página.');
        }

        return $next($request);
    }
}
