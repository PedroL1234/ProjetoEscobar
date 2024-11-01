<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Api;
use App\Models\Reservas; 
use App\Models\Clientes; 
use App\Models\Estoque; 

class TelegramBotController extends Controller
{
    protected $telegram;

    public function __construct()
    {
        // Inicializa a API do Telegram com o token definido no .env
        $this->telegram = new Api(env('7949806698:AAGQCSb7USOoPvDrxris8t0uKTdOt03jlzs'));
    }

    public function reservar(Request $request)
    {
        // Valida os dados da requisição
        $validatedData = $request->validate([
            'fk_cli_id' => 'required|exists:clientes,id',
            'fk_est_id' => 'required|exists:estoques,id',
        ]);

        // Cria a reserva no banco de dados
        $reserva = Reservas::create([
            'fk_cli_id' => $validatedData['fk_cli_id'],
            'fk_est_id' => $validatedData['fk_est_id'],
        ]);

        // Obtém os dados do cliente e do estoque
        $cliente = Clientes::find($validatedData['fk_cli_id']);
        $estoque = Estoque::find($validatedData['fk_est_id']);

        // Mensagem a ser enviada via Telegram
        $mensagem = "Nova Reserva Realizada!\n";
        $mensagem .= "Nome do Cliente: {$cliente->cli_nome}\n";
        $mensagem .= "Email: {$cliente->cli_email}\n";
        $mensagem .= "Telefone: {$cliente->cli_telefone}\n";
        $mensagem .= "Roupa Reservada: {$estoque->est_nome}\n";

        // Envia a mensagem para um chat específico no Telegram
        $this->telegram->sendMessage([
            'chat_id' => env('-4528342492'), // Defina o ID do chat no arquivo .env
            'text' => $mensagem,
        ]);

        // Retorna uma resposta de sucesso
        return response()->json(['status' => 'success', 'message' => 'Reserva realizada e notificada com sucesso!']);
    }
}
