<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;
use App\Models\Reservas;
use App\Models\Estoque;
use Telegram\Bot\Api;

class ClienteController extends Controller
{
    protected $telegram;

    public function __construct()
    {
        // Inicializa a API do Telegram com o token definido no .env
        $this->telegram = new Api(env('TELEGRAM_BOT_TOKEN')); // Use o nome da variável de ambiente correta
    }

    public function index()
    {
        $clientes = Clientes::all();
        $estoques = Estoque::all(); 
        return view("admin.template_admin.reservas", compact('clientes', 'estoques'));
    }

    public function index2()
    {
        $clientes = Clientes::all();
        $estoques = Estoque::all(); 
        return view("cliente.mostruario.welcome2", compact('clientes', 'estoques'));
    }

    public function SalvarCliente(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefone' => 'required|string|max:255',
            'fk_est_id' => 'required|exists:estoque,id', // ID da roupa
        ]);
    
        // Cria o cliente
        $cliente = Clientes::create([
            'cli_nome' => $request->input('nome'),
            'cli_email' => $request->input('email'),
            'cli_numero' => $request->input('telefone'),
        ]);
    
        // Cria a reserva no banco de dados
        $reserva = Reservas::create([
            'fk_cli_id' => $cliente->id,
            'fk_est_id' => $request->input('fk_est_id'),
        ]);

        // Obtém os dados do estoque
        $estoque = Estoque::find($request->input('fk_est_id'));

        // Mensagem a ser enviada via Telegram
        $mensagem = "Nova Reserva Realizada!\n";
        $mensagem .= "Nome do Cliente: {$cliente->cli_nome}\n";
        $mensagem .= "Email: {$cliente->cli_email}\n";
        $mensagem .= "Telefone: {$cliente->cli_numero}\n";
        $mensagem .= "Roupa Reservada: {$estoque->est_nome}\n";
        $mensagem .= "Agradecemos!";

        // Envia a mensagem para um chat específico no Telegram
        $this->telegram->sendMessage([
            'chat_id' => env('TELEGRAM_CHAT_ID'), // Corrigido para usar a variável de ambiente correta
            'text' => $mensagem,
        ]);

        return redirect()->route('principal')->with('success', 'Cliente salvo e reserva realizada com sucesso!');
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
        ]);

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
