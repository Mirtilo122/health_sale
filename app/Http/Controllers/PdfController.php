<?php

namespace App\Http\Controllers;

use App\Models\SolicitacaoOrcamento;
use App\Models\Orcamento;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function gerarPdf($codigo_solicitacao)
    {
        $solicitacao = SolicitacaoOrcamento::findOrFail($codigo_solicitacao);

        $orcamento = Orcamento::where('codigo_solicitacao', $codigo_solicitacao)->firstOrFail();

        $options = [
            'isHtml5ParserEnabled' => true,
            'isPhpEnabled' => true,
            'isRemoteEnabled' => true,
            'fontDir' => public_path('\fonts'),
        ];

        $data = Carbon::now()->locale('pt_BR')->translatedFormat('d \d\e F \d\e Y');


        PDF::setOptions($options);

        $pdf = PDF::loadView('pdf.relatorio', compact('solicitacao', 'orcamento', 'data'));

        return $pdf->download('orcamento_' . $codigo_solicitacao . '.pdf');
    }
}
