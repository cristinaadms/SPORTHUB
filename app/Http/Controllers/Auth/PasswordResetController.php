<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password; 

class PasswordResetController extends Controller 
{
    # Exibe o formulário para solicitar o link de recuperação
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    # Envia o link de redefinição de senha para o email informado
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status = Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
}
