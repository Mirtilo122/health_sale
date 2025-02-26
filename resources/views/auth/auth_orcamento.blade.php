@php

    $status = $solicitacao->status;

    $paginaAtual = Route::currentRouteName();

    $paginasPermitidas = [
        'novo' => ['orcamento.atribuir'],
        'atribuido' => ['orcamento.designar'],
        'cirurgiao' => ['orcamento.cirurgiao'],
        'anestesista' => ['orcamento.anestesia'],
        'criacao' => ['orcamento.criar'],
        'liberacao' => ['orcamento.liberacao'],
        'negociacao' => ['orcamento.negociacao'],
    ];


    if (!in_array($paginaAtual, $paginasPermitidas[$status] ?? [])) {
        return redirect()->route('dashboard')->with('error', 'Ação não permitida.');
    }
@endphp
