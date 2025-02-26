<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Orçamento {{ $orcamento->codigo_orcamento }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/modelo_orcamento.css">
</head>
<body>
    <main>
        <img src="/imagens/logo_modelo.jpg" alt="">
        <h1>PREVISÃO DE CUSTOS</h1>

        <div class="row d-flex mt-4">
            <div class="col-md-8">
                <p><strong>PACIENTE:</strong> {{ ucfirst($orcamento->nome_paciente) ?? 'Não informado' }}</p>
                <p><strong>Cidade/UF:</strong> {{ ucfirst($orcamento->cidade) ?? 'Não informado' }}</p>
                <p><strong>Convenio:</strong> {{ ucfirst($orcamento->convenio) ?? 'Não informado' }}</p>
                <p><strong>Cirurgião:</strong> {{ ucfirst($orcamento->cirurgiao_responsavel->usuario) ?? 'Não informado' }}</p>
                <p><strong>Atendente:</strong> {{ ucfirst($solicitacao->responsavel->usuario) ?? 'Não informado' }}</p>
            </div>

            <div class="col-md-4">
                <p><strong>Solicitante:</strong> {{ ucfirst($orcamento->nome_solicitante) ?? 'Não informado' }}</p>
                <p><strong>Tipo:</strong> {{ ucfirst($orcamento->tipo_orcamento) ?? 'Não informado' }}</p>
            </div>
        </div>

        <div class="row d-flex mt-4">
            <h4>01 - Procedimento</h4>
            <p><strong>{{$orcamento->cod_tuss_principal ?? 'Não informado' }}</strong> - {{ ucfirst($orcamento->procedimento_principal) ?? 'Não informado' }}</p>

            @forelse ($orcamento->procedimentos_secundarios as $procedimento_secundarios)
            <p><strong>{{$procedimento_secundarios->cod_tuss_principal ?? 'Não informado' }}</strong> - {{ ucfirst($procedimento_secundarios->procedimento_principal) ?? 'Não informado' }}</p>
            @empty
            @endforelse
        </div>






    </main>

</body>
</html>
