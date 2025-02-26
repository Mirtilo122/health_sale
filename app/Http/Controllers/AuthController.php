<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuarios;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'senha' => 'required',
        ]);


        if (Auth::attempt(['email' => $request->email, 'password' => $request->senha])) {

            $usuario = Auth::user();


            session()->put([
                'id' => $usuario->id,
                'nome' => $usuario->usuario,
                'acesso' => $usuario->acesso,
                'aba_ativa' => 'favoritos-tab'
            ]);

            return redirect()->route('dashboard');
        }

        return redirect()->back()->with('error', 'E-mail ou senha incorretos!');
    }

    public function logout()
    {
        // Limpa a sessão e faz logout
        session()->flush();
        Auth::logout();

        return redirect()->route('login');
    }

}

