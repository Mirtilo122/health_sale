<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Orçamento {{ $orcamento->codigo_orcamento }}</title>
    <style>

        @font-face {
            font-family: 'Inter';
            src: url('fonts/Inter-Regular.ttf');
        }

        @font-face {
            font-family: 'Poppins';
            src: url('fonts/Poppins-Regular.ttf');
        }

        @font-face {
            font-family: 'Poppins_Bold';
            src: url('fonts/Poppins-Bold.ttf');
        }

        body {
            color: #333;
            font-size: 1rem; /* 16px */
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            background-color: #fff;
            display: flex;
            justify-content: center;
        }

        h1, h4 {
            text-align: center;
        }

        .money {
            font-family: "Poppins_Bold";
            font-weight: 400;
            font-style: normal;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
            color: #212529;
            border: solid 2pxrgb(85, 85, 85);
        }



        .table-bordered {
            border: 1px solid #dee2e6;
        }
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.075);
        }

        .table th {
            background-color: #f8f9fa;
            text-align: center;
        }

        .table td {
            text-align: left;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }

        thead, tr, th{
            padding: 5px;
            height: 10px;
        }

        td, th {
            padding: 2px 5px;
            line-height: 1;
        }

        .condicoes {
            width: 100%;
            margin-top: 20px;
        }

        textarea {
            width: 96%;
            max-width: 100%;
            height: 120px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 10px;
            font-size: 14px;
            background-color: #f9f9f9;
            color: #333;
            box-sizing: border-box;
        }

        .signature {
            text-align: center;
            margin-top: 50px;
        }

        .linha_assinatura {
            width: 100%;
            height: 1px;
            background-color: #000;
            margin-bottom: 20px;
        }

        .contact {
            text-align: center;
            margin-top: 20px;
        }

        .contact p {
            margin: 5px 0;
        }

        .section p {
            text-align: center;
            font-size: 14px;
        }

        .section {
            margin-top: 30px;
        }

        h1{
            font-family: "Inter";
            font-weight: 400;
            font-style: normal;
            font-size: 50px;
        }

        h2{
            font-family: "Poppins_Bold";
            font-weight: 400;
            font-style: normal;
            font-size: 30px;
        }

        h3{
            font-family: "Poppins_Bold";
            font-weight: 400;
            font-style: normal;
            font-size: 25px;
        }

        h4{
            font-family: "Poppins_Bold";
            font-weight: 400;
            font-style: normal;
            font-size: 20px;
        }

        h5{
            font-family: "Poppins_Bold";
            font-weight: 400;
            font-style: normal;
            font-size: 15px;
        }

        p{
            font-family: "Poppins";
            font-weight: 400;
            font-style: normal;
            font-size: 13px;
        }

        strong{
            font-family: "Poppins_Bold";
            font-weight: 400;
            font-style: normal;
        }

        .container{
            width: 95%;
            padding-right: 15px;
            padding-left: 15px;
            display: flex;
            flex-direction: column;
            gap: 25px;
            justify-content: center;
            align-items: center;
        }

        .img-fluid {
            max-width: 40%;
            height: auto;
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }

        .d-block {
            display: block;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
            border: solid 1px rgb(228, 228, 228);
            border-radius: 10px;
            padding: 5px;
        }

        .mt-4 {
            margin-top: 1.5rem;
        }

        .mb-2 {
            margin-top: 0.5rem;
        }

        .col-md-8 {
            flex: 0 0 66.666667%;
            max-width: 66.666667%;
        }

        .col-md-4 {
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
        }

        .col-10 {
            flex: 0 0 83.333333%;
            max-width: 83.333333%;
        }

        .col-2 {
            flex: 0 0 16.666667%;
            max-width: 16.666667%;
        }

        .text-end {
            text-align: right;
        }

        section {
            display: block;
            padding: 1rem 0;
        }

        .titulo{
            width: 100%;
        }

        .container_img{
            width: 100%;
            padding-left: 30%;
            padding-right: 30%;
        }

        .avoid-break {
            page-break-inside: avoid; /* Impede que um bloco seja dividido entre páginas */
        }

    </style>
</head>
<body>

    <main class="container py-4">
        <div class="container_img">
        <img src="imagens/logo_modelo.jpg" alt="Logo do Hospital" class="img-fluid mx-auto d-block">
        </div>


        <h1>PROPOSTA</h1>

        <div class="row mt-4">
            <div class="col-md-8">
                <p><strong>PACIENTE:</strong> {{ $orcamento->nome_paciente ? ucfirst($orcamento->nome_paciente) : 'Não informado' }}</p>
                <p><strong>Cidade/UF:</strong> {{ $orcamento->cidade ? ucfirst($orcamento->cidade) : 'Não informado' }}</p>
                <p><strong>Convenio:</strong> {{ $orcamento->convenio ? ucfirst($orcamento->convenio) : 'Não informado' }}</p>
                <p><strong>Cirurgião:</strong> {{ $orcamento->cirurgiao_responsavel?->usuario ? ucfirst($orcamento->cirurgiao_responsavel->usuario) : 'Não informado' }}</p>
            </div>

            <div class="col-md-4">
                <p><strong>Solicitante:</strong> {{ ucfirst($orcamento->nome_solicitante) ?? 'Não informado' }}</p>
                <p><strong>Tipo:</strong> {{ ucfirst($orcamento->tipo_orcamento) ?? 'Não informado' }}</p>
                <p><strong>Atendente:</strong> {{ $solicitacao->responsavel?->usuario ? ucfirst($solicitacao->responsavel->usuario) : 'Não informado' }}</p>

            </div>
        </div>

        <div class="row mt-4 avoid-break">
            <h4 class="titulo">01 - Procedimentos</h4>
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

        <div class="row mt-4 avoid-break">
            <h4 class="titulo">02 - Cirurgião</h4>
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

        <div class="row mt-4 avoid-break">
            <h4 class="titulo">03 - Anestesista</h4>
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

        <div class="row mt-4 avoid-break">
            <h4 class="titulo">04 - Hospitalar Diarias, Taxas e Visitas</h4>
            <input type="hidden" id="precosProcedimentosLoad" value='{{ old("precos_procedimentos", $orcamento->precos_procedimentos ?? "[]") }}'>
            <table class="table mt-3 table-bordered table-striped table-hover">
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

        <div class="row mt-4 avoid-break">
            <h4 class="titulo">05 - Materiais (Ortes, Proteses e Sintese)</h4>
            <p>Não Solicitados</p>
        </div>

        <div class="row mt-4 avoid-break">
            <h4 class="titulo">06 - Condições Gerais</h4>
            <div class="condicoes mt-4 mb-2">
                <textarea id="condPagamentoAnestesista" disabled>{{ $orcamento->cond_pagamento_anestesista }}</textarea>
                <p><strong>Validade Orçamento:</strong> {{ $orcamento->validade }}</p>
            </div>
        </div>

        <div class="section">
            <p>Sinop/MT, {{ \Carbon\Carbon::now()->locale('pt_BR')->translatedFormat('d \d\e F \d\e Y') }}</p>
            <div class="linha_assinatura"></div><p class="signature">Assinatura do responsável</p>
        </div>
    </main>
</body>
<script src="/js/modelo_orcamento.js"></script>
</html>
