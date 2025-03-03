<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Orçamento {{ $orcamento->codigo_orcamento }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/modelo_orcamento.css">
</head>
<body>
    <main class="container">
        <img src="/imagens/logo_modelo.jpg" alt="Logo do Hospital" class="img-fluid mx-auto d-block">
        <h1>PREVISÃO DE CUSTOS</h1>

        <div class="row mt-4">
            <div class="col-md-8">
                <p><strong>PACIENTE:</strong> {{ $orcamento->nome_paciente ? ucfirst($orcamento->nome_paciente) : 'Não informado' }}</p>
                <p><strong>Cidade/UF:</strong> {{ $orcamento->cidade ? ucfirst($orcamento->cidade) : 'Não informado' }}</p>
                <p><strong>Convenio:</strong> {{ $orcamento->convenio ? ucfirst($orcamento->convenio) : 'Não informado' }}</p>
                <p><strong>Cirurgião:</strong> {{ $orcamento->cirurgiao_responsavel?->usuario ? ucfirst($orcamento->cirurgiao_responsavel->usuario) : 'Não informado' }}</p>
                <p><strong>Atendente:</strong> {{ $solicitacao->responsavel?->usuario ? ucfirst($solicitacao->responsavel->usuario) : 'Não informado' }}</p>
            </div>

            <div class="col-md-4">
                <p><strong>Solicitante:</strong> {{ ucfirst($orcamento->nome_solicitante) ?? 'Não informado' }}</p>
                <p><strong>Tipo:</strong> {{ ucfirst($orcamento->tipo_orcamento) ?? 'Não informado' }}</p>
            </div>
        </div>

        <div class="row mt-4">
            <h4>01 - Procedimento</h4>
            <p><strong>{{$orcamento->cod_tuss_principal ?? 'Não informado' }}</strong> - {{ ucfirst($orcamento->procedimento_principal) ?? 'Não informado' }}</p>

            @php
            $procedimentos_secundarios = json_decode($orcamento->procedimentos_secundarios);
            @endphp
            @if (!empty($procedimentos_secundarios))
                @foreach ($procedimentos_secundarios as $procedimento_secundario)
                <p><strong>{{$procedimento_secundario->cod_tuss_principal ?? 'Não informado' }}</strong> - {{ ucfirst($procedimento_secundario->procedimento_principal) ?? 'Não informado' }}</p>
                @endforeach
            @endif
        </div>

        <div class="row mt-4">
            <h4>02 - Cirurgião</h4>
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="col-10"><h5>Descrição</h5></th>
                        <th scope="col" class="col-2"><h5>Valor</h5></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row"><p>Cirurgião Principal</p></td>
                        <td><p id="valorCirurgiao" class="money text-end">{{ $orcamento->taxa_cirurgiao['cirurgiaoPrincipal'] ?? '' }}</p></td>
                    </tr>
                    <tr>
                        <td scope="row"><p>Cirurgião Auxiliar</p></td>
                        <td><p id="valorCirurgiao" class="money text-end">{{ $orcamento->taxa_cirurgiao['cirurgiaoAuxiliar'] ?? '' }}</p></td>
                    </tr>
                    <tr>
                        <td scope="row"><p>Instrumentador</p></td>
                        <td><p id="valorCirurgiao" class="money text-end">{{ $orcamento->taxa_cirurgiao['instrumentador'] ?? '' }}</p></td>
                    </tr>
                    <tr>
                        <td scope="row"><p>Outros Custos de Cirurgião</p></td>
                        <td><p id="valorCirurgiao" class="money text-end">{{ $orcamento->taxa_cirurgiao['outrosCustos'] ?? '' }}</p></td>
                    </tr>
                    @php
                    $valor_total_cirurgiao = $orcamento->taxa_cirurgiao['cirurgiaoPrincipal'] + $orcamento->taxa_cirurgiao['cirurgiaoAuxiliar'] + $orcamento->taxa_cirurgiao['instrumentador'] + $orcamento->taxa_cirurgiao['outrosCustos'];
                    @endphp
                    <tr>
                        <td scope="row"><strong>Total</strong></td>
                        <td class="text-end"><strong>{{ number_format((float)$valor_total_cirurgiao, 2, ',', '')}}</strong></td>
                    </tr>
                </tbody>
            </table>
            <div class="condicoes mt-4 mb-2">
                <h4>Condições de Pagamento Cirurgião</h4>
                <textarea id="condPagamentoCirurgiao" disabled>{{ $orcamento->cond_pagamento_cirurgiao }}</textarea>
            </div>
        </div>

        <div class="row mt-4">
            <h4>03 - Anestesista</h4>
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="col-10"><h5>Descrição</h5></th>
                        <th scope="col" class="col-2"><h5>Valor</h5></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row"><p>Taxa Anestesia</p></td>
                        <td><p class="money text-end">{{ $orcamento->taxa_anestesista['taxaAnestesia'] ?? '0,00' }}</p></td>
                    </tr>
                    <tr>
                        <td scope="row"><p>Outros Custos de Anestesia</p></td>
                        <td><p class="money text-end">{{ $orcamento->taxa_anestesista['outrosCustosAnestesia'] ?? '00,00' }}</p></td>
                    </tr>
                    @php
                    $valor_total_anestesista = $orcamento->taxa_anestesista['outrosCustosAnestesia'] + $orcamento->taxa_anestesista['taxaAnestesia'];
                    @endphp
                    <tr>
                        <td scope="row"><strong>Total</strong></td>
                        <td class="text-end"><strong>{{ number_format((float)$valor_total_anestesista, 2, ',', '')}}</strong></td>
                    </tr>
                </tbody>
            </table>
            <div class="condicoes mt-4 mb-2">
                <h4>Condições de Pagamento Anestesista</h4>
                <textarea id="condPagamentoAnestesista" disabled>{{ $orcamento->cond_pagamento_anestesista }}</textarea>
            </div>
        </div>

        <div class="row mt-4">
            <h4>04 - Hospitalar Diarias, Taxas e Visitas</h4>
            <input type="hidden" id="precosProcedimentosLoad" value='{{ old("precos_procedimentos", $orcamento->precos_procedimentos ?? "[]") }}'>
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th><h5>Nome</h5></th>
                        <th><h5>Quantidade</h5></th>
                        <th><h5>Valor Unitário</h5></th>
                        <th><h5>Valor Total</h5></th>
                    </tr>
                </thead>
                <tbody id="tabela-procedimentos">
                </tbody>
            </table>
            <div class="condicoes mt-4 mb-2">
                <h4>Condições de Pagamento Hospital</h4>
                <textarea id="condPagamentoHospital" disabled>{{ $orcamento->cond_pagamento_hosp }}</textarea>
            </div>
        </div>

        <div class="row mt-4">
            <h4>05 - Materiais (Ortes, Proteses e Sintese)</h4>
            <p>Não Solicitados</p>
        </div>

        <div class="row mt-4">
            <h4>06 - Condições Gerais</h4>
            <div class="condicoes mt-4 mb-2">
                <h4>Condições de Pagamento Anestesistas</h4>
                <textarea id="condPagamentoAnestesista" disabled>{{ $orcamento->cond_pagamento_anestesista }}</textarea>
                <p><strong>Validade Orçamento:</strong> {{ $orcamento->validade }}</p>
            </div>
        </div>

        <div class="section">
            <p>Sinop/MT, {{ \Carbon\Carbon::now()->locale('pt_BR')->translatedFormat('d \d\e F \d\e Y') }}</p>
            <p class="signature">__________________________<br>Assinatura do responsável</p>
        </div>
    </main>
</body>
</html>
<script src="/js/modelo_orcamento.js"></script>
</html>
