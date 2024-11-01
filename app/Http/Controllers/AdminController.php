<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Exibe a página de administração
    public function index()
{
    if (Auth::user()->adm_perm) {
        $users = User::all(); 
        return view('admin.template_admin.perm', compact('users')); 
    }
    return redirect('/')->withErrors(['access' => 'Você não tem permissão para acessar esta área.']);
}

    public function togglePermission(Request $request, User $user)
    {
        if (!Auth::user()->adm_perm) {
            return redirect('/')->withErrors(['access' => 'Você não tem permissão para realizar esta ação.']);
        }

        $user->adm_perm = !$user->adm_perm;
        $user->save();

        return redirect()->back()->with('success', 'Permissão alterada com sucesso!');
    }
}
