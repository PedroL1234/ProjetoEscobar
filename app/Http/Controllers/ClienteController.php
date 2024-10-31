<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estoque;
use App\Models\Clientes;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Clientes::all();
        return view("admin.template_admin.reservas", compact('clientes'));
    }
    public function index2()
    {
        $clientes = Clientes::all();
        $estoque = Estoque::all();
        return view("cliente.mostruario.welcome2", compact('clientes','estoque'));
    }

    public function SalvarCliente(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefone' => 'required|string|max:255',
        ]);
        Clientes::create([
            'cli_nome' => $request->input('nome'),
            'cli_email' => $request->input('email'),
            'cli_numero' => $request->input('telefone'),
        ]);

        return redirect()->route('principal')->with('success', 'Cliente salvo com sucesso!');
    }

    public function edit($id)
    {
        $cliente = Clientes::findOrFail($id);
        return response()->json($cliente);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefone' => 'required|string|max:255',
        ] );

        $cliente = Clientes::findOrFail($id);
        $cliente->update([
            'cli_nome' => $request->input('nome'),
            'cli_email' => $request->input('email'),
            'cli_numero' => $request->input('telefone'),
        ]);

        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy($id)
{
    $cliente = Clientes::findOrFail($id);
    $cliente->delete(); 

    return redirect()->route('clientes.index')->with('success', 'Cliente excluído com sucesso!');
}
}
