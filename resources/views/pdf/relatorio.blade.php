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
    font-size: 12pt;
    color: #333;
    background-color: #fff;
    text-align: justify;
    font-family: "Poppins";
    font-weight: 400;
    font-style: normal;
}

h1, h2, h3, h4, h5 {
    font-family: "Poppins_Bold";
    font-weight: 400;
    font-style: normal;
    text-align: center;
}

h1 {
    font-size: 24px; /* Ajuste de tamanho para título principal */
}

h2 {
    font-size: 18px; /* Subtítulo de seção */
}

h3 {
    font-size: 16px; /* Subtítulo de subseção */
}

h4, h5 {
    font-size: 14px; /* Menor título */
}

p {
    font-family: "Poppins";
    font-weight: 400;
    font-style: normal;
    font-size: 12px;
    color: #333;
    text-align: justify;
}

strong {
    font-family: "Poppins_Bold";
    font-weight: 400;
    font-style: normal;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 7px;
    margin-bottom: 7px;
    color: #212529;
}

table, th, td {
    border: 1px solid #000;
}

th, td {
    padding: 3px;
    text-align: left;
    vertical-align: middle;
}

th {
    background-color: #f2f2f2;
    text-align: center;
    font-family: "Poppins_Bold";
    font-weight: 400;
    font-style: normal;
    font-size: 14px;
}

td {
    text-align: left;
    font-family: "Poppins";
    font-weight: 400;
    font-style: normal;
    font-size: 12px;
    padding-left: 10px;
}

thead tr th{
    height: 10px;
}

thead th, tfoot td {
    padding: 0px;
    margin: 0;
}

.table-bordered th, .table-bordered td {
    border: 1px solid #dee2e6;
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: #f9f9f9;
}

.table-hover tbody tr:hover {
    background-color: #f1f1f1;
}

textarea {
    width: 98%;
    max-width: 98%;
    height: 50px;
    border: 1px solid #ced4da;
    border-radius: 5px;
    padding: 4px;
    font-size: 12px;
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

.contact p, .section p {
    font-size: 12pt;
}

.section {
    margin-top: 30px;
}

.container {
    width: 100%;
}

.col-md-8, .col-md-6, .col-md-4, .col-10, .col-2 {
    padding: 0 15px;
}

.col-md-8 {
    max-width: 66.666667%;
}

.col-md-6 {
    max-width: 50%;
}

.col-md-4 {
    max-width: 33.333333%;
}

.col-md-3 {
    max-width: 25%;
}

.col-10 {
    max-width: 83.333333%;
}

.col-2 {
    max-width: 16.666667%;
}

.text-end {
    text-align: right;
}

section {
    display: block;
    margin-top: 10px;
}

.titulo {
    width: 100%;
}

.container_img {
    width: 100%;
    padding-left: 30%;
    padding-right: 25%;
}

.avoid-break {
    page-break-inside: avoid;
}

.page-break {
    page-break-before: always;
}

.page-break-inside-avoid {
    page-break-inside: avoid;
}

.table-custom {
    border: none;
    border-collapse: collapse;
    width: 100%;
    margin-left: 5%;
}

.table-custom td {
    border: none;
    padding: 0;
    text-align: left;
    width: 33.333%;
}

.table-custom tr {
    border: none
}

.rodape {
    position: absolute;
    bottom: 0;
    left: 0;
    padding-left: 6%;
    padding-right: 0px;
}

</style>

</head>
<body>

    <main class="container">
        <div class="container_img">
        <img src="imagens/logo_modelo.jpg" alt="Logo do Hospital" class="img-fluid mx-auto d-block">
        </div>


        <h2>PROPOSTA</h2>

        <table class="table-custom">
            <tbody>
                <tr>
                    <td><p><strong>Código Solicitação:</strong> {{ $orcamento->codigo_solicitacao ?? 'Não informado' }}</p></td>
                    <td><p><strong>Paciente:</strong> {{ $orcamento->nome_paciente ? ucfirst($orcamento->nome_paciente) : 'Não informado' }}</p></td>
                    <td><p><strong>Atendente:</strong> {{ $orcamento->responsavel?->usuario ? ucfirst($orcamento->responsavel->usuario) : 'Não informado' }}</p></td>
                </tr>
                <tr>
                    <td><p><strong>Protocolo:</strong> {{ $solicitacao->protocolo ?? 'Não informado' }}</p></td>
                    <td><p><strong>Nascimento:</strong> {{ $orcamento->data_nascimento ? \Carbon\Carbon::parse($orcamento->data_nascimento)->format('d/m/Y') : 'Não informado' }}</p></td>
                    <td><p><strong>Cirurgião:</strong> {{ $orcamento->cirurgiao_responsavel?->usuario ? ucfirst($orcamento->cirurgiao_responsavel->usuario) : 'Não informado' }}</p></td>
                </tr>
                <tr>
                    <td><p><strong>Tipo de Orçamento:</strong> {{ ucfirst($orcamento->tipo_orcamento) ?? 'Não informado' }}</p></td>
                    <td><p><strong>Cidade/UF:</strong> {{ $orcamento->cidade ? ucfirst($orcamento->cidade) : 'Não informado' }}</p></td>
                    <td><p><strong>Data Provável:</strong> {{ $orcamento->data_provavel ? \Carbon\Carbon::parse($orcamento->data_provavel)->format('d/m/Y') : 'Não informado' }}</p></td>
                </tr>
                <tr>
                    <td<p><strong>Solicitante:</strong> {{ ucfirst($orcamento->nome_solicitante) ?? 'Não informado' }}</p></td>
                    <td><p><strong>Convenio:</strong> {{ $orcamento->convenio ? ucfirst($orcamento->convenio) : 'Não informado' }}</p></td>
                    <td><p><strong>Validade:</strong> {{ $solicitacao->validade ? \Carbon\Carbon::parse($solicitacao->validade)->format('d/m/Y') : 'Não informado' }}</p></td>
                </tr>
                <tr>
                    <td><p><strong>Telefone:</strong> {{ $orcamento->telefone ?? 'Não informado' }}</p></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <section class="avoid-break">
            <h4 class="titulo">01 - Procedimentos</h4>
            <p><strong>{{$orcamento->cod_tuss_principal ?? 'Não informado' }}</strong> - {{ ucfirst($orcamento->procedimento_principal) ?? 'Não informado' }}</p>

            @php
            $procedimentos_secundarios = json_decode($orcamento->procedimentos_secundarios);

            @endphp
            @foreach ($procedimentos_secundarios as $procedimento_secundario)
            <p><strong>{{$procedimento_secundario->codTuss ?? 'Não informado' }}</strong> - {{ $procedimento_secundario->procedimento ?? 'Não informado' }}</p>
            @endforeach
        </section>

        <?php
        $dadosCirurgiao = $orcamento->taxa_cirurgiao;
        $totalValorCirurgiao = 0;
        $totalPrazoCirurgiao = 0;
        $exibirValorPrazoCirurgiao = false;

        foreach ($dadosCirurgiao as $taxa) {
            if ($taxa["Prazo"] > 0) {
                $exibirValorPrazoCirurgiao = true;
                break;
            }
        }
        ?>

        <div>
            <h4 class="titulo">02 - Honorarios Medicos</h4>
            <table class="table table-bordered table-striped table-hover" style="border-radius: 5px; overflow: hidden;">
                <tbody>
                    <tr style="background-color:#2d7b4b; color: #ffffff;">
                        <td>Descrição</td>
                        <td>Valor</td>
                        <?php if ($exibirValorPrazoCirurgiao): ?>
                            <td>Valor a Prazo</td>
                        <?php endif; ?>
                    </tr>
                    <?php if (!empty($dadosCirurgiao) && is_array($dadosCirurgiao)): ?>
                        <?php foreach ($dadosCirurgiao as $taxa): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($taxa["Nome"]); ?></td>
                                <td>R$ <?php echo number_format($taxa["Valor"], 2, ',', '.'); ?></td>
                                <?php if ($exibirValorPrazoCirurgiao): ?>
                                    <td>R$ <?php echo number_format($taxa["Prazo"], 2, ',', '.'); ?></td>
                                <?php endif; ?>
                            </tr>

                            <?php
                            $totalValorCirurgiao += $taxa["Valor"];
                            $totalPrazoCirurgiao += $taxa["Prazo"];
                            ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Nenhuma informação disponível.</p>
                    <?php endif; ?>
                    <tr style="background-color: #aaaaaa;">
                        <td>Total</td>
                        <td scope="col">R$ <?php echo number_format($totalValorCirurgiao, 2, ',', '.'); ?></td>
                        <?php if ($exibirValorPrazoCirurgiao): ?>
                            <td scope="col">R$ <?php echo number_format($totalPrazoCirurgiao, 2, ',', '.'); ?></td>
                        <?php endif; ?>
                    </tr>
                </tbody>
            </table>
                <textarea id="condPagamentoCirurgiao" disabled>{{ $orcamento->cond_pagamento_cirurgiao }}</textarea>
        </div>

        <?php
        $dadosAnestesista = $orcamento->taxa_anestesista;
        $totalValorAnestesista = 0;
        $totalPrazoAnestesista = 0;
        $exibirValorPrazoAnestesista = false;

        foreach ($dadosAnestesista as $taxa) {
            if ($taxa["Prazo"] > 0) {
                $exibirValorPrazoAnestesista = true;
                break;
            }
        }
        ?>

        <div class="avoid-break">
            <h4 class="titulo">03 - Anestesista</h4>
            <table class="table table-bordered table-striped table-hover" style="border-radius: 5px; overflow: hidden;">
                <tbody>
                    <tr style="background-color:#2d7b4b; color: #ffffff;">
                        <td>Descrição</td>
                        <td>Valor</td>
                        <?php if ($exibirValorPrazoAnestesista): ?>
                            <td>Valor a Prazo</td>
                        <?php endif; ?>
                    </tr>
                    <?php if (!empty($dadosAnestesista) && is_array($dadosAnestesista)): ?>
                    <?php foreach ($dadosAnestesista as $taxa): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($taxa["Nome"]); ?></td>
                            <td>R$ <?php echo number_format($taxa["Valor"], 2, ',', '.'); ?></td>
                            <?php if ($exibirValorPrazoAnestesista): ?>
                            <td>R$ <?php echo number_format($taxa["Prazo"], 2, ',', '.'); ?></td>
                            <?php endif; ?>
                        </tr>
                        <?php
                        $totalValorAnestesista += $taxa["Valor"];
                        $totalPrazoAnestesista += $taxa["Prazo"];
                        ?>
                    <?php endforeach; ?>
                    <?php else: ?>
                        <p>Nenhuma informação disponível.</p>
                    <?php endif; ?>
                    <tr style="background-color: #aaaaaa;">
                        <td>Total</td>
                        <td scope="col">R$ <?php echo number_format($totalValorAnestesista, 2, ',', '.'); ?></td>
                        <?php if ($exibirValorPrazoAnestesista): ?>
                            <td scope="col">R$ <?php echo number_format($totalPrazoAnestesista, 2, ',', '.'); ?></td>
                        <?php endif; ?>
                    </tr>
                </tbody>
            </table>
                <textarea id="condPagamentoAnestesista" disabled>{{ $orcamento->cond_pagamento_anestesista }}</textarea>
        </div>


        <?php
        $dadosHospital = json_decode($orcamento->precos_procedimentos);
        $totalValorHospital = 0;
        $totalPrazoHospital = 0;
        $exibirValorPrazoHospital = false;


        foreach ($dadosHospital as $taxa) {
            if ($taxa->valorPrazo > 0) {
                $exibirValorPrazoHospital = true;
                break;
            }
        }
        ?>
        <div class="avoid-break">
            <h4 class="titulo">04 - Hospitalar Diarias, Taxas e Visitas</h4>
            <table class="table mt-3 table-bordered table-striped table-hover" style="border-radius: 5px; overflow: hidden;">
                <tbody>
                    <tr style="background-color:#2d7b4b; color: #ffffff;">
                        <td>Nome</td>
                        <td>Quantidade</td>
                        <td>Valor Unitário</td>
                        <td>Valor Total</td>
                        <?php if ($exibirValorPrazoHospital): ?>
                            <td>Valor a Prazo</td>
                            <td>Valor Total a Prazo</td>
                        <?php endif; ?>
                    </tr>
                    <?php if (!empty($dadosHospital) && is_array($dadosHospital)): ?>
                    <?php foreach ($dadosHospital as $taxa): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($taxa->nome); ?></td>
                            <td><?php echo htmlspecialchars($taxa->qntd); ?></td>
                            <td>R$ <?php echo number_format($taxa->valor, 2, ',', '.'); ?></td>
                            <td>R$ <?php echo number_format(($taxa->valor * $taxa->qntd), 2, ',', '.'); ?></td>

                            <?php if ($exibirValorPrazoHospital): ?>
                            <td>R$ <?php echo number_format($taxa->valorPrazo, 2, ',', '.'); ?></td>
                            <td>R$ <?php echo number_format(($taxa->valorPrazo * $taxa->qntd), 2, ',', '.'); ?></td>
                            <?php endif; ?>
                        </tr>
                        <?php
                        $totalValorHospital += $taxa->valor * $taxa->qntd;
                        $totalPrazoHospital += $taxa->valorPrazo * $taxa->qntd;
                        ?>
                    <?php endforeach; ?>
                    <?php else: ?>
                        <p>Nenhuma informação disponível.</p>
                    <?php endif; ?>
                    <tr style="background-color: #aaaaaa;">
                        <td>Total</td>
                        <td></td>
                        <td></td>
                        <td scope="col">R$ <?php echo number_format($totalValorHospital, 2, ',', '.'); ?></td>
                        <?php if ($exibirValorPrazoHospital): ?>
                            <td></td>
                            <td scope="col">R$ <?php echo number_format($totalPrazoAnestesista, 2, ',', '.'); ?></td>
                        <?php endif; ?>
                    </tr>
                </tbody>
            </table>
                <textarea id="condPagamentoHospital" disabled>{{ $orcamento->cond_pagamento_hosp }}</textarea>
        </div>

<!--        <div class="row mt-4 avoid-break">
            <h4 class="titulo">05 - Materiais (Ortes, Proteses e Sintese)</h4>
            <p>Não Solicitados</p>
        </div>
                        -->
        <div class="avoid-break">
            <h4 class="titulo">06 - Condições Gerais</h4>
            <div class="condicoes mt-4 mb-2">
                <textarea id="condicoesGerais" disabled>{{ $orcamento->condicoes_gerais }}</textarea>
            </div>
        </div>

        <div class="section">
            <p style="font-size: 12px;">Sinop/MT, {{ $data}}</p> <br><br><br>
            <div class="linha_assinatura"></div><p class="signature">Assinatura do responsável</p>
        </div>

        <div class="container_img rodape">
        <img src="imagens/rodape_modelo.jpg" alt="" class="img-fluid mx-auto d-block">
        </div>
    </main>
</body>
</html>
