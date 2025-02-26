@php

    $status = ucfirst(strtolower($orcamento->status));

    $paginaAtual = Route::currentRouteName();

    $paginasPermitidas = [
        'Novo' => ['orcamento.atribuir'],
        'Atribuido' => ['orcamento.designar'],
        'Cirurgiao' => ['orcamento.cirurgiao'],
        'Anestesista' => ['orcamento.anestesia'],
        'Criacao' => ['orcamento.criar'],
        'Liberacao' => ['orcamento.liberacao'],
        'Negociacao' => ['orcamento.negociacao'],
    ];


    if (!in_array($paginaAtual, $paginasPermitidas[$status] ?? [])) {
        return redirect()->route('dashboard')->with('error', 'Ação não permitida.');
    }
@endphp
