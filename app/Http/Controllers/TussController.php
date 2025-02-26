<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tuss;
use Illuminate\Support\Facades\Session;

class TussController extends Controller
{
    public function index()
    {
        return view('tabelaTuss.importar_tuss');
    }

    public function import(Request $request)
    {
        set_time_limit(300);

        $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('csv_file');

        if (($handle = fopen($file->getPathname(), "r")) !== false) {
            while (($data = fgetcsv($handle, 1000, ",", '"')) !== false) {
                // Verifica se há pelo menos dois elementos no array
                if (isset($data[0]) && isset($data[1])) {
                    $codigo = trim($data[0], '"');
                    $descricao = trim($data[1], '"');

                    // Converte para UTF-8 caso necessário
                    $codigo = mb_convert_encoding($codigo, "UTF-8", "auto");
                    $descricao = mb_convert_encoding($descricao, "UTF-8", "auto");

                    Tuss::updateOrCreate(
                        ['codigo' => $codigo],
                        ['descricao' => $descricao]
                    );
                } else {
                    // Log ou debug para identificar a linha problemática
                    \Log::warning('Linha inválida encontrada no CSV: ' . json_encode($data));
                }
            }
            fclose($handle);
        }

        return redirect()->route('importar.tuss')->with('success', 'Arquivo importado com sucesso!');
    }
}
