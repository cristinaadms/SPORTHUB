<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Exibir formulário de login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Processar login
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'Digite um email válido.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos 6 caracteres.',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            // Redirecionar baseado no role do usuário
            if ($user->isAdmin()) {
                return redirect()->intended('/admin/dashboard')
                    ->with('success', 'Login realizado com sucesso! Bem-vindo, ' . $user->name);
            }
            
            return redirect()->intended('/dashboard')
                ->with('success', 'Login realizado com sucesso! Bem-vindo, ' . $user->name);
        }

        return back()
            ->withErrors(['email' => 'Credenciais inválidas.'])
            ->withInput($request->only('email'));
    }

    /**
     * Exibir formulário de registro
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Processar registro
     */
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'telefone' => 'required|string|max:20|unique:users',
            'password' => 'required|string|min:6|confirmed',
            // 'terms' => 'accepted',
        ], [
            'name.required' => 'O campo nome é obrigatório.',
            'name.max' => 'O nome não pode ter mais de 255 caracteres.',
            
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'Digite um email válido.',
            'email.unique' => 'Este email já está cadastrado.',
            'email.max' => 'O email não pode ter mais de 255 caracteres.',
            
            'telefone.required' => 'O campo telefone é obrigatório.',
            'telefone.unique' => 'Este telefone já está cadastrado.',
            'telefone.max' => 'O telefone não pode ter mais de 20 caracteres.',
            
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos 6 caracteres.',
            'password.confirmed' => 'A confirmação da senha não confere.',
            
            'terms.accepted' => 'Você deve aceitar os termos de uso.',
        ]);

        if ($validator->fails()) {
            // Debug: Ver os erros
            // dd($validator->errors()->all());
            
            return back()
                ->withErrors($validator)
                ->withInput($request->only('name', 'email', 'telefone'));
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'telefone' => $request->telefone,
                'password' => Hash::make($request->password),
                'role' => 'user',
                'nota' => 0, // Valor padrão
            ]);

            Auth::login($user);

            return redirect()->route('dashboard')
                ->with('success', 'Conta criada com sucesso! Bem-vindo, ' . $user->name);

        } catch (\Exception $e) {
            // Debug: Ver o erro
            // dd($e->getMessage());
            
            return back()
                ->withErrors(['error' => 'Erro ao criar conta. Tente novamente.'])
                ->withInput($request->only('name', 'email', 'telefone'));
        }
    }

    /**
     * Realizar logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')
            ->with('success', 'Logout realizado com sucesso!');
    }

    /**
     * Exibir formulário de recuperação de senha
     */
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Enviar link de reset de senha
     */
    public function sendResetLink(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'Digite um email válido.',
            'email.exists' => 'Email não encontrado em nossa base de dados.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Aqui você implementaria o envio do email
        // Por exemplo, usando Laravel's Password Reset
        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', 'Link de recuperação enviado para seu email!')
            : back()->withErrors(['email' => 'Erro ao enviar link de recuperação.']);
    }
}