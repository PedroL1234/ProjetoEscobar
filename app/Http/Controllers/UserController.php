<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->adm_perm = $request->has('adm_perm') ? 1 : 0;
        $user->save();

        return redirect()->back()->with('success', 'Permissão atualizada com sucesso.');
    }
}
