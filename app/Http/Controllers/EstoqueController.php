<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\estoque;

class EstoqueController extends Controller
{
    public function index()
    {
        $estoque = Estoque::all();
        return view("admin.categoria.index", compact('estoque'));

    }
    public function SalvarNovaR(Request $request){
        $est_tipo = $request->input('est_tipo');
        $est_descricao = $request->input('est_descricao');
        
        
        
        $estoque = new Estoque();
        $estoque->est_tipo = $est_tipo;
        $estoque->est_descricao = $est_descricao;
        $estoque->est_quantia = $est_quantia;
        $estoque->est_ativo= $est_ativo;
        $estoque->save();


        return redirect ("admin.categoria.index");
        
    }
        public function buscar($id)
        {
            $estoqueItem = Estoque::findOrFail($id);
            return view('admin.categoria.alterar', compact('estoqueItem'));
        }
    
        public function est_alterar(Request $request, $id)
        {
            $request->validate([
                'est_tipo' => 'required|string|max:255',
                'est_descricao' => 'required|string|max:255',
                'est_quantia' => 'required|integer',
                'est_ativo' => 'required|boolean',
            ]);
    
            $estoqueItem = Estoque::findOrFail($id);
            $estoqueItem->est_tipo = $request->input('est_tipo');
            $estoqueItem->est_descricao = $request->input('est_descricao');
            $estoqueItem->est_quantia = $request->input('est_quantia');
            $estoqueItem->est_ativo = $request->input('est_ativo');
            $estoqueItem->save();
    
            return redirect()->route('estoque.index')->with('success', 'Produto atualizado com sucesso!');
        }
        public function destroy($id)
        {
            $estoqueItem = Estoque::findOrFail($id);
            $estoqueItem->delete();

            return redirect()->route('estoque.index')->with('success', 'Produto excluído com sucesso!');
        }

        
    }

