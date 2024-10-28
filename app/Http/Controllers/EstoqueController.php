<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estoque;
use App\Models\Imagem;

class EstoqueController extends Controller
{
    public function index()
    {
        $estoque = Estoque::all();
        return view("admin.categoria.index", compact('estoque'));
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
            'est_quantia' => 'required|integer',
            'est_tamanho' => 'required|string|max:50',
            'est_descricao' => 'required|string|max:255',
            'imagem' => 'nullable|image|max:2048',
        ]);
        
        $est_quantia = $request->input('est_quantia');   
        $est_tamanho = $request->input('est_tamanho');
        $est_descricao = $request->input('est_descricao');
        $fk_img_id = null;

        if ($request->hasFile('imagem')) {
            $imagemPath = $request->file('imagem')->store('imagens', 'public'); // Armazena a imagem

            // Salva a imagem na tabela de imagens
            $imagem = new Imagem();
            $imagem->caminho = $imagemPath;
            $imagem->save();

            $fk_img_id = $imagem->id; // Obtém o ID da imagem salva
        }
        
        $estoque = new Estoque();
        $estoque->est_tamanho = $est_tamanho;
        $estoque->est_descricao = $est_descricao;
        $estoque->est_quantia = $est_quantia;
        $estoque->fk_img_id = $fk_img_id;

        $estoque->save();

        return redirect()->route("admin.categoria.index")->with('success', 'Produto salvo com sucesso!');
    }

    public function buscar($id)
    {
        $estoqueItem = Estoque::findOrFail($id);
        return view('admin.categoria.alterar', compact('estoqueItem'));
    }

    public function est_alterar(Request $request, $id)
    {
        $request->validate([
            'imagem' => 'nullable|image|max:2048',
            'est_tamanho' => 'required|string|max:255',
            'est_descricao' => 'required|string|max:255',
            'est_quantia' => 'required|integer',
        ]);
    
        $estoqueItem = Estoque::findOrFail($id);
        $estoqueItem->est_tamanho = $request->input('est_tamanho');
        $estoqueItem->est_descricao = $request->input('est_descricao');
        $estoqueItem->est_quantia = $request->input('est_quantia');

        if ($request->hasFile('imagem')) {
            $imagemPath = $request->file('imagem')->store('imagens', 'public'); // Armazena a nova imagem

            // Salva a nova imagem na tabela de imagens
            $imagem = new Imagem();
            $imagem->caminho = $imagemPath;
            $imagem->save();

            $estoqueItem->fk_img_id = $imagem->id; // Atualiza o ID da imagem
        }

        $estoqueItem->save();
    
        return redirect()->route('estoque.index')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $estoqueItem = Estoque::findOrFail($id);
        $estoqueItem->delete();

        return redirect()->route('estoque.index')->with('success', 'Produto excluído com sucesso!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'imagem' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        // Processamento do arquivo de imagem
        if ($request->hasFile('imagem')) {
            $file = $request->file('imagem');
            $path = $file->store('imagens', 'public'); 

            $imagem = new Imagem();
            $imagem->caminho = $path;
            $imagem->save();

            return redirect()->back()->with('success', 'Imagem enviada com sucesso!');
        }

        return redirect()->back()->with('error', 'Erro ao enviar a imagem.');
    }
}
