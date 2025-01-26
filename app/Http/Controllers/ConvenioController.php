<?php

namespace App\Http\Controllers;

use App\Models\Convenio;
use App\Models\TabelaPreco;
use Illuminate\Http\Request;

class ConvenioController extends Controller
{
    public function index()
    {
        
    }




    public function armazenar(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'tabela_de_precos_id' => 'required|exists:tabela_de_precos,id',
        ]);

        Convenio::create($request->all());

        return redirect()->route('convenios.index')->with('success', 'Convênio criado com sucesso!');
    }





    public function atualizar(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'tabela_de_precos_id' => 'required|exists:tabela_de_precos,id',
        ]);

        $convenio = Convenio::findOrFail($id);
        $convenio->update($request->all());

        return redirect()->route('convenios.index')->with('success', 'Convênio atualizado com sucesso!');
    }
}
