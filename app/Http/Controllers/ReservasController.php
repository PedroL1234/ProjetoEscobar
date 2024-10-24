<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservasController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all(['cli_nome', 'cli_email', 'cli_numero']);
        return view('reserva.index', compact('clientes'));
    }
}
