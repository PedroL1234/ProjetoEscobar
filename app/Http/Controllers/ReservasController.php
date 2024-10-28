<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservas; 
use App\Models\Cliente;

class ReservasController extends Controller
{
    public function index()
    {
        $reservas = Reservas::all();
        return view('admin.template_admin.reservas', compact('reservas'));
    }
    
    public function edit($id)
        {
    
    $reservas = Reservas::find($id);

    
    if (!$reservas) {
        return redirect()->route('admin.template_admin.reservas')->with('error', 'Usuário não encontrado.');
    }

    
    return view('admin.template_admin.editar', compact('reservas'));
}


// <------------------------------------------------------------------------------------------->
    public function update(Request $request, Reservas $reservas)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:reservass,email,' . $reservas->id,
            'reservas' => 'nullable|string|min:3',
        ]);

        $reservas->update([
            'name' => $request->name,
            'email' => $request->email,
            'reservas' => $request->reservas ? bcrypt($request->reservas) : $reservas->reservas,
        ]);

        return redirect()->route('admin.template_admin.reservas')->with('success', 'Usuário atualizado com sucesso!');
    }

// <------------------------------------------------------------------------------------------->

    // Deleta um usuário
    public function destroy(Reservas $reserva)
    {
        $reserva->delete();
        return redirect()->route('reservas')->with('success', 'Usuário deletado com sucesso!');
    }
}





    
