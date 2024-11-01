<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            // Verifica se o usuário tem permissão de admin
            $user = Auth::user();
            if ($user->adm_perm == 0) {
                Auth::logout(); // Faz logout do usuário
                return redirect('/')->withErrors(['access' => 'Você não tem permissão para acessar esta área.']);
            }

            $request->session()->regenerate();
            return redirect()->route('estoque.index'); // Redireciona para a página do estoque
        }

        return back()->withErrors([
            'email' => 'As credenciais fornecidas estão incorretas.',
        ]);
    }

    public function registrar(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'adm_perm' => 0, // Definindo a permissão como 0 para novos usuários
        ]);

        return view('admin.template_admin.login');
    }
}
