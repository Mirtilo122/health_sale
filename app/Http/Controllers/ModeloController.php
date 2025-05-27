<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modelo;
use App\Models\ModeloPadrao;

class ModeloController extends Controller
{
    public function index()
    {
        $modelos = Modelo::all();
        return view('modelos.index', compact('modelos'));
    }


    public function create()
    {
        return view('modelos.create');
    }

    public function show()
    {
        return view('modelos.create'); 
    }

    public function store(Request $request)
    {


        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string|max:500',
            'conteudo' => 'required|string',
        ]);



        Modelo::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'conteudo' => $request->conteudo,
            'ativo' => $request->has('ativo'),
        ]);

        return redirect()->route('modelos.index')->with('success', 'Modelo criado com sucesso!');
    }


    public function edit(Modelo $modelo)
    {
        return view('modelos.edit', compact('modelo'));
    }

    public function update(Request $request, Modelo $modelo)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string|max:500',
            'conteudo' => 'required|string',
        ]);

        $modelo->update([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'conteudo' => $request->conteudo,
            'ativo' => $request->has('ativo'),
        ]);

        return redirect()->route('modelos.index')->with('success', 'Modelo atualizado com sucesso!');
    }

    public function destroy(Modelo $modelo)
    {
        $modelo->delete();
        return redirect()->route('modelos.index')->with('success', 'Modelo excluído com sucesso!');
    }

    public function padrao() {
        $modelos = Modelo::all();
        $modeloPadroes = ModeloPadrao::all()->keyBy('tipo');

        return view('modelos.padroes', compact('modelos', 'modeloPadroes'));
    }
    public function salvarPadrao(Request $request)
    {
        $tipos = [
            'condicoes_gerais',
            'pagamento_hospital',
            'pagamento_cirurgiao',
            'pagamento_anestesista',
        ];

        foreach ($tipos as $tipo) {
            ModeloPadrao::where('tipo', $tipo)->update([
                'modelo_id' => $request->input($tipo) ?: null,
            ]);
        }

        return redirect()->route('modelos.index')->with('success', 'Padrões atualizados com sucesso!');
    }
}
