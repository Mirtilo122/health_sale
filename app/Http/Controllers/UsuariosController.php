<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Exception;

class UsuariosController extends Controller
{
    public function index(Request $request)
    {
        $orderBy = $request->get('sort', 'id');
        $orderDirection = $request->get('order', 'asc') === 'asc' ? 'desc' : 'asc';

        $usuarios = Usuarios::where('acesso', '!=', 'Externo')
                    ->where('ativo', 1)
                    ->orderBy($orderBy, $orderDirection)
                    ->get();

        $usuario_externo = Usuarios::where('acesso', '=', 'Externo')
                                ->where('ativo', 1)
                                ->orderBy($orderBy, $orderDirection)
                                ->get();

        $inativos = Usuarios::where('ativo', 0)
                            ->orderBy($orderBy, $orderDirection)
                            ->get();

        return view('usuarios.usuarios', compact('usuarios', 'usuario_externo', 'inativos', 'orderBy', 'orderDirection'));
    }

    public function mostrarRegistro()
    {
        return view('usuarios.novo');
    }

    public function registrar(Request $request)
    {
        try {
            $request->validate([
                'usuario' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:usuarios'],
                'senha' => ['required'],
            ]);

            Usuarios::create([
                'usuario' => $request->usuario,
                'email' => $request->email,
                'senha' => Hash::make($request->password),
                'acesso' => $request->acesso,
            ]);

            return redirect()->route('usuarios.usuarios')->with('success', 'Usuário registrado com sucesso!');
        } catch (ValidationException $e) {
                return redirect()->route('usuarios.registrar')->withErrors($e->errors());
        } catch (QueryException $e) {
                return redirect()->route('usuarios.registrar')->with('error', 'Erro no banco de dados: ' . $e->getMessage());
        } catch (Exception $e) {
                return redirect()->route('usuarios.registrar')->with('error', 'Erro inesperado: ' . $e->getMessage());
        }

    }



    public function editar($id)
    {
        $usuario = Usuarios::findOrFail($id);
        return view('usuarios.editar', compact('usuario'));
    }



    public function atualizar(Request $request, $id)
    {
        $usuario = Usuarios::findOrFail($id);

        $request->validate([
            'usuario' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'senha' => ['nullable'],
        ]);

        $emailExistente = Usuarios::where('email', $request->email)->where('id', '!=', $id)->exists();

        if ($emailExistente) {
            return redirect()->back()->with('error', 'O e-mail já está sendo utilizado por outro usuário.');
        }

        try {
            $usuario->usuario = $request->usuario;
            $usuario->email = $request->email;
            $usuario->acesso = $request->acesso;

            if (!empty($request->senha)) {
                $usuario->senha = Hash::make($request->senha);
            }

            $usuario->save();

            return redirect()->route('usuarios.usuarios')->with('success', 'Usuário atualizado com sucesso!');
        } catch (Exception $e) {
            return redirect()->route('usuarios.editar', ['id' => $id])->with('error', 'Erro ao atualizar usuário: ' . $e->getMessage());
        }
    }


    public function destroy($id)
    {
        $usuario = Usuarios::findOrFail($id);
        $usuario->ativo = 0;
        $usuario->save();
        return redirect()->route('usuarios.usuarios')->with('success', 'Usuário inativado com sucesso!');
    }
}
