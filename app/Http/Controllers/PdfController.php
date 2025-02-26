<?php

namespace App\Http\Controllers;
use App\Models\SolicitacaoOrcamento;
use App\Models\Orcamento;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function gerarPdf($codigo_solicitacao)
    {

        $solicitacao = SolicitacaoOrcamento::findOrFail($codigo_solicitacao);
        $orcamento = Orcamento::where('codigo_solicitacao', $codigo_solicitacao)->firstOrFail();

//        return view('pdf.relatorio', compact('solicitacao', 'orcamento'));

        $pdf = PDF::loadView('pdf.relatorio', compact('solicitacao','orcamento'));


        return $pdf->download('orcamento_' . $codigo_solicitacao . '.pdf');
    }
}

