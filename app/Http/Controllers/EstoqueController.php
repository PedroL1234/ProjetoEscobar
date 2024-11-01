<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estoque;
use App\Models\Imagem;

class EstoqueController extends Controller
{
    public function index()
    {
        $estoque = Estoque::with(['imagem'])->get();
        return view("admin.categoria.index", compact('estoque'));
    }

    public function index2()
    {
        $estoque = Estoque::all(); // Ou sua lógica para buscar os itens do estoque
        return view('cliente.mostruario.welcome2', compact('estoque'));
    }

    public function verifica()
    {
        if (!auth()->user() || auth()->user()->adm_perm !== 1) {
            return redirect('/')->with('error', 'Acesso negado.');
        }

        return view('estoque.index');
    }

    public function SalvarNovaR(Request $request)
    {
        $request->validate([
            'est_tamanho' => 'required|string|max:50',
            'est_nome' => 'required|string|max:255',
            'est_valor' => 'required|numeric',
            'est_descricao' => 'required|string|max:255',
            'est_quantia' => 'required|integer',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $estoque = new Estoque();
        $estoque->est_tamanho = $request->input('est_tamanho');
        $estoque->est_nome = $request->input('est_nome');
        $estoque->est_valor = $request->input('est_valor');
        $estoque->est_descricao = $request->input('est_descricao');
        $estoque->est_quantia = $request->input('est_quantia');
        
        if ($request->hasFile('imagem')) {
            $imagemPath = $request->file('imagem')->store('imagens', 'public');

            $imagem = new Imagem();
            $imagem->caminho = $imagemPath;
            $imagem->save();

            $estoque->fk_img_id = $imagem->id;
        }

        $estoque->save();

        return redirect()->route("estoque.index")->with('success', 'Produto salvo com sucesso!');
    }

    public function buscar($id)
    {
        $estoqueItem = Estoque::findOrFail($id);
        return view('admin.categoria.alterar', compact('estoqueItem'));
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'imagem' => 'nullable|image|max:2048',
            'est_tamanho' => 'required|string|max:255',
            'est_nome' => 'required|string|max:255',
            'est_valor' => 'required|numeric',
            'est_descricao' => 'required|string|max:255',
            'est_quantia' => 'required|integer',
        ]);

        $estoqueItem = Estoque::findOrFail($id);
        $estoqueItem->est_tamanho = $request->input('est_tamanho');
        $estoqueItem->est_nome = $request->input('est_nome');
        $estoqueItem->est_valor = $request->input('est_valor');
        $estoqueItem->est_descricao = $request->input('est_descricao');
        $estoqueItem->est_quantia = $request->input('est_quantia');

        if ($request->hasFile('imagem')) {
            $imagemPath = $request->file('imagem')->store('imagens', 'public');

            $imagem = new Imagem();
            $imagem->caminho = $imagemPath;
            $imagem->save();

            $estoqueItem->fk_img_id = $imagem->id;
        }

        $estoqueItem->save();

        return redirect()->route('estoque')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $estoqueItem = Estoque::findOrFail($id);
        $estoqueItem->delete();

        return redirect()->route('estoque')->with('success', 'Produto excluído com sucesso!');
    }
}
