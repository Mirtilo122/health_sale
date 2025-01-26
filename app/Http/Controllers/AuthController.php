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
        // Validação dos dados
        $request->validate([
            'email' => 'required|email',
            'senha' => 'required',
        ]);

        // Tenta autenticar o usuário
        if (Auth::attempt(['email' => $request->email, 'password' => $request->senha])) {
            return redirect()->route('dashboard');
        }

        return redirect()->back()->with('error', 'E-mail ou senha incorretos!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

}

