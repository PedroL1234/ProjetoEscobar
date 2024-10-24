<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public function index(){
        $clientes = Cliente::all();
        return view("cliente.mostruario.welcome2", compact("clientes"));
    }

    public function SalvarCliente(Request $request){
        $nome = $request->input('nome');
        $email = $request->input('email');
        $telefone = $request->input('telefone');

        $cliente = new Cliente();
        $cliente->cli_nome = $nome;
        $cliente->cli_email = $email;
        $cliente->cli_numero = $telefone; 
        $cliente->save();

        return redirect()->route('principal'); 
    }
}
