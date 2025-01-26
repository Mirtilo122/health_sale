<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Procedimentos;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Exception;

class ProcedimentosController extends Controller
{
    public function index(Request $request)
    {
        $orderBy = $request->get('sort', 'id');
        $orderDirection = $request->get('order', 'asc') === 'asc' ? 'desc' : 'asc';

        $procedimentos = Procedimentos::orderBy($orderBy, $orderDirection)->get();

        return view('procedimentos.index', compact('procedimentos', 'orderBy', 'orderDirection'));
    }

    public function criar()
    {
        return view('procedimentos.novo');
    }

    public function salvar(Request $request)
    {
        try {
            $request->validate([
                'nome' => ['required', 'string', 'max:255'],
                'tipo' => ['required', 'string', 'max:255'],
                'ativo' => ['required', 'boolean'],
            ]);

            Procedimentos::create([
                'nome_procedimento' => $request->nome,
                'tipo' => $request->tipo,
                'ativo' => $request->ativo,
            ]);

            return redirect()->route('procedimentos.index')->with('success', 'Usuário registrado com sucesso!');
        } catch (ValidationException $e) {
                return redirect()->route('procedimentos.criar')->withErrors($e->errors());
        } catch (QueryException $e) {
                return redirect()->route('procedimentos.criar')->with('error', 'Erro no banco de dados: ' . $e->getMessage());
        } catch (Exception $e) {
                return redirect()->route('procedimentos.criar')->with('error', 'Erro inesperado: ' . $e->getMessage());
        }

    }


    public function editar($id)
    {
        $procedimento = Procedimentos::findOrFail($id);
        return view('procedimentos.editar', compact('procedimento'));
    }



    public function atualizar(Request $request, $id)
    {
        $procedimento = Procedimentos::findOrFail($id);



        $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'tipo' => ['required', 'string', 'max:255'],
            'ativo' => ['required', 'boolean'],
        ]);

        try {
            $procedimento->nome_procedimento = $request->nome;
            $procedimento->tipo = $request->tipo;
            $procedimento->ativo = $request->ativo;

            $procedimento->save();

            return redirect()->route('procedimentos.index')->with('success', 'Procedimento atualizado com sucesso!');
        } catch (Exception $e) {
            return redirect()->route('procedimentos.editar')->with('error', 'Erro ao atualizar o procedimento: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $procedimento = Procedimentos::findOrFail($id);
        $procedimento->delete();
        return redirect()->route('procedimentos.index')->with('success', 'Procedimento deletado com sucesso!');
    }
}
