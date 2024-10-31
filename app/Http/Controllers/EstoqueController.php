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
        $imagem = Imagem::all();
        return view("admin.categoria.index", compact('estoque','imagem'));
        
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
            'est_descricao' => 'required|string|max:255',
            'est_quantia' => 'required|integer',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            
        ]);
        
        $est_quantia = $request->input('est_quantia');   
        $est_tamanho = $request->input('est_tamanho');
        $est_descricao = $request->input('est_descricao');
        $fk_img_id = null;

        if ($request->hasFile('imagem')) {
            $imagemPath = $request->file('imagem')->store('imagens', 'public'); 

            $imagem = new Imagem();
            $imagem->caminho = $imagemPath;
            $imagem->save();

            $fk_img_id = $imagem->id;
        }
        
        $estoque = new Estoque();
        $estoque->est_tamanho = $est_tamanho;
        $estoque->est_descricao = $est_descricao;
        $estoque->est_quantia = $est_quantia;
        $estoque->fk_img_id = $fk_img_id;

        $estoque->save();

        return redirect()->route("estoque.index")->with('success', 'Produto salvo com sucesso!');
    }

    public function buscar($id)
    {
        $estoqueItem = Estoque::findOrFail($id);
        return view('admin.categoria.alterar', compact('estoqueItem'));
    }

    public function edit(Request $request)
    {
        $request->validate([
            'id'=>'required|integer',
            'imagem' => 'nullable|image|max:2048',
            'est_tamanho' => 'required|string|max:255', 
            'est_descricao' => 'required|string|max:255',
            'est_quantia' => 'required|integer',
            'fk_img_id' => 'nullable|integer',
        ]);
    
        $estoqueItem = Estoque::where($id,'id')->first;
        $estoqueItem->est_tamanho = $request->input('nome');
        $estoqueItem->est_descricao = $request->input('descricao');
        $estoqueItem->est_quantia = $request->input('quantia'); 

        if ($request->hasFile('imagem')) {
            $imagemPath = $request->file('imagem')->store('imagens', 'public'); 

            $imagem = new Imagem();
            $imagem->caminho = $imagemPath;
            $imagem->save();

            $estoqueItem->fk_img_id = $imagem->id;
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
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
