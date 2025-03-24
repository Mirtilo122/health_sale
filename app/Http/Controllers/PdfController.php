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

        $cond_pagamento_cirurgiao = Orcamento::where('codigo_solicitacao', $codigo_solicitacao)->value('cond_pagamento_cirurgiao') ?? '';
        $cond_pagamento_cirurgiao = str_replace(["\r\n", "\n", "\r"], '', $cond_pagamento_cirurgiao);

        $cond_pagamento_anestesista = Orcamento::where('codigo_solicitacao', $codigo_solicitacao)->value('cond_pagamento_anestesista') ?? '';
        $cond_pagamento_anestesista = str_replace(["\r\n", "\n", "\r"], '', $cond_pagamento_anestesista);

        $cond_pagamento_hospital = Orcamento::where('codigo_solicitacao', $codigo_solicitacao)->value('cond_pagamento_hosp') ?? '';
        $cond_pagamento_hospital = str_replace(["\r\n", "\n", "\r"], '', $cond_pagamento_hospital);

        $cond_gerais = Orcamento::where('codigo_solicitacao', $codigo_solicitacao)->value('condicoes_gerais') ?? '';
        $cond_gerais = str_replace(["\r\n", "\n", "\r"], '', $cond_gerais);


        PDF::setOptions($options);

        $pdf = PDF::loadView('pdf.relatorio', compact('solicitacao', 'orcamento', 'data', 'cond_pagamento_cirurgiao', 'cond_pagamento_anestesista', 'cond_pagamento_hospital', 'cond_gerais'));

        return $pdf->download('orcamento_' . $codigo_solicitacao . '.pdf');
    }
}
