<?php

namespace App\Http\Controllers;

use App\Models\Prestador;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Exception;

class PrestadorController extends Controller
{
    public function index()
    {
        $prestadores = Prestador::with('usuario')->get();
        return view('prestadores.index', compact('prestadores'));
    }

    public function create()
    {
        return view('prestadores.create');
    }

    public function store(Request $request)
    {
        if (is_null($request->crm)) {
            $request->merge(['crm' => '']);
        }



        try {
            $request->validate([
                'usuario' => 'required|string|max:50',
                'email' => 'required|string|email|max:255|unique:usuarios',
                'senha' => 'required',
                'crm' => 'nullable|string',
                'funcao' => 'required',
            ]);



            $usuario = Usuarios::create([
                'usuario' => $request->usuario,
                'email' => $request->email,
                'senha' => Hash::make($request->senha),
                'acesso' => 'Externo',
                'funcao' => $request->funcao,
            ]);



            $usuario->refresh();

            Prestador::create([
                'nome' => $request->usuario,
                'crm' => $request->crm,
                'especialidade' => $request->especialidade,
                'funcao' => $request->funcao,
                'usuario_id' => $usuario->id,
            ]);

            return redirect()->route('prestadores.index')->with('success', 'Prestador cadastrado com sucesso!');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors());
        } catch (QueryException $e) {
            return back()->with('error', 'Erro no banco de dados: ' . $e->getMessage());
        } catch (Exception $e) {
            return back()->with('error', 'Erro inesperado: ' . $e->getMessage());
        }
    }

    public function edit($idprestador)
    {
        $prestador = Prestador::findOrFail($idprestador);
        $usuario = Usuarios::where('id', $prestador->usuario_id)->first();

        return view('prestadores.edit', compact('usuario', 'prestador'));
    }


    public function update(Request $request)
    {

        $prestador = Prestador::findOrFail($request->id);


        try {
            $request->merge([
                'crm' => $request->get('crm', '')
            ]);

            $request->validate([
                'crm' => 'nullable|string',
                'funcao' => 'required|in:Anestesista,Cirurgião',
                'especialidade' => 'nullable|string|max:50',
                'senha' => 'nullable|min:6'
            ]);

            $prestador->update($request->only(['nome', 'crm', 'especialidade', 'funcao']));


            $usuario = Usuarios::find($prestador->usuario_id);

            if ($usuario) {
                $usuario->update([
                    'usuario' => $request->nome,
                    'funcao' => $request->funcao,
                    'senha' => $request->filled('senha') ? bcrypt($request->senha) : $usuario->senha
                ]);
            }

            return redirect()->route('prestadores.index')->with('success', 'Prestador atualizado com sucesso!');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors());
        } catch (QueryException $e) {
            return back()->with('error', 'Erro no banco de dados: ' . $e->getMessage());
        } catch (Exception $e) {
            return back()->with('error', 'Erro inesperado: ' . $e->getMessage());
        }
    }

    public function destroy($idprestador)
    {
        $prestador = Prestador::findOrFail($idprestador);
        try {
            $usuario = Usuarios::find($prestador->usuario_id);
            $usuario->delete();
            $prestador->delete();

            return redirect()->route('prestadores.index')->with('success', 'Prestador removido com sucesso!');
        } catch (Exception $e) {
            return back()->with('error', 'Erro ao excluir: ' . $e->getMessage());
        }
    }
}
