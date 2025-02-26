@extends('layouts.admin')

@section('titulo', 'Painel Administrativo')

@section('nome_pagina', 'INÍCIO')

@section('conteudo')

<main>
        @php

            use Illuminate\Support\Str;

            $idUsuario = auth()->id();
            $usuario = auth()->user();
            $nivelAcesso = $usuario->acesso;
            $funcao = $usuario->funcao;

            $podeAcessarTudo = in_array($nivelAcesso, ['Administrador', 'Gerente']);
            $ehCirurgiao = $funcao == 'Cirurgião';
            $ehAnestesista = $funcao == 'Anestesista';
            $ehAgente = $nivelAcesso == 'Agente';

            if ($ehCirurgiao) {
                $solicitacoes = $solicitacoes->filter(fn($s) => $s->orcamento && $s->orcamento->id_usuarios_cirurgioes == $idUsuario);
            } elseif ($ehAnestesista) {
                $solicitacoes = $solicitacoes->filter(fn($s) => $s->orcamento && $s->orcamento->id_usuarios_anestesistas == $idUsuario);
            } elseif ($ehAgente) {

                $solicitacoes = $solicitacoes->filter(function ($solicitacao) use ($idUsuario) {
                    $orcamento = $solicitacao->orcamento;

                    if (!$orcamento) {
                        return $solicitacao->id_usuario == $idUsuario;
                    }

                    $idUsuariosEditar = json_decode($orcamento->id_usuarios_editar, true) ?? [];
                    $idUsuariosVisualizar = json_decode($orcamento->id_usuarios_visualizar, true) ?? [];

                    return
                        $solicitacao->id_usuario == $idUsuario ||
                        $orcamento->id_usuario_responsavel == $idUsuario ||
                        in_array($idUsuario, $idUsuariosEditar) ||
                        in_array($idUsuario, $idUsuariosVisualizar);
                });

            }


        @endphp


    <div class="container">
        <h2 class="text-center my-4">Solicitações de Orçamento</h2>

        @php
            $abaAtiva = session('aba_ativa', 'favoritos-tab');
        @endphp

        <ul class="nav nav-tabs" id="myTab" role="tablist">

            <li class="nav-item">
                <button class="nav-link {{ $abaAtiva == 'favoritos-tab' ? 'active' : '' }}" id="favoritos-tab" data-bs-toggle="tab" data-bs-target="#favoritos-tab-pane">
                    Favoritas ({{ $solicitacoes->filter(fn($s) => Str::contains($s->favoritos, (string) $idUsuario))->count() }})
                </button>
            </li>

            @if ($podeAcessarTudo)
                <li class="nav-item">
                    <button class="nav-link {{ $abaAtiva == 'novos-tab' ? 'active' : '' }}" id="novos-tab" data-bs-toggle="tab" data-bs-target="#novos-tab-pane">
                        Novas ({{ $solicitacoes->where('status', 'novo')->count() }})
                    </button>
                </li>
            @endif

            @if ($podeAcessarTudo || $ehAgente)
                <li class="nav-item">
                    <button class="nav-link {{ $abaAtiva == 'atribuido-tab' ? 'active' : '' }}" id="atribuido-tab" data-bs-toggle="tab" data-bs-target="#atribuido-tab-pane">
                        Atribuídas ({{ $solicitacoes->where('status', 'atribuido')->count() }})
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link {{ $abaAtiva == 'cirurgiao-tab' ? 'active' : '' }}" id="cirurgiao-tab" data-bs-toggle="tab" data-bs-target="#cirurgiao-tab-pane">
                        Aguardando Cirurgião ({{ $solicitacoes->where('status', 'cirurgiao')->count() }})
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link {{ $abaAtiva == 'anestesista-tab' ? 'active' : '' }}" id="anestesista-tab" data-bs-toggle="tab" data-bs-target="#anestesista-tab-pane">
                        Aguardando Anestesista ({{ $solicitacoes->where('status', 'anestesista')->count() }})
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link {{ $abaAtiva == 'orcamento-tab' ? 'active' : '' }}" id="orcamento-tab" data-bs-toggle="tab" data-bs-target="#orcamento-tab-pane">
                        Finalizando Orçamento ({{ $solicitacoes->where('status', 'criacao')->count() }})
                    </button>
                </li>
            @endif

            @if ($podeAcessarTudo)
                <li class="nav-item">
                    <button class="nav-link {{ $abaAtiva == 'liberacao-tab' ? 'active' : '' }}" id="liberacao-tab" data-bs-toggle="tab" data-bs-target="#liberacao-tab-pane">
                        Liberação ({{ $solicitacoes->where('status', 'liberacao')->count() }})
                    </button>
                </li>
            @endif

            @if ($podeAcessarTudo || $ehAgente)
                <li class="nav-item">
                    <button class="nav-link {{ $abaAtiva == 'negociacao-tab' ? 'active' : '' }}" id="negociacao-tab" data-bs-toggle="tab" data-bs-target="#negociacao-tab-pane">
                        Negociação ({{ $solicitacoes->where('status', 'negociacao')->count() }})
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link {{ $abaAtiva == 'concluidos-tab' ? 'active' : '' }}" id="concluidos-tab" data-bs-toggle="tab" data-bs-target="#concluidos-tab-pane">
                        Concluídas ({{ $solicitacoes->whereIn('status', ['perdido', 'aprovado', 'recusado'])->count() }})
                    </button>
                </li>
            @endif

            @if ($ehCirurgiao)
                <li class="nav-item">
                    <button class="nav-link {{ $abaAtiva == 'cirurgiao-tab' ? 'active' : '' }}" id="cirurgiao-tab" data-bs-toggle="tab" data-bs-target="#cirurgiao-tab-pane">
                        Aguardando Cirurgião ({{ $solicitacoes->where('status', 'cirurgiao')->count() }})
                    </button>
                </li>
            @endif

            @if ($ehAnestesista)
                <li class="nav-item">
                    <button class="nav-link {{ $abaAtiva == 'anestesista-tab' ? 'active' : '' }}" id="anestesista-tab" data-bs-toggle="tab" data-bs-target="#anestesista-tab-pane">
                        Aguardando Anestesista ({{ $solicitacoes->where('status', 'anestesista')->count() }})
                    </button>
                </li>
            @endif



        </ul>

        <div class="tab-content" id="myTabContent">


            <!-- Novos -->

            <div class="tab-pane  fade show align-top text-start {{ $abaAtiva == 'novos-tab' ? 'active' : '' }}" id="novos-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

            <div class="tituloTabelas">
                <h4>Novas Solicitações</h4>
                @include('admin.filtro')
            </div>
            <br>

                @include('tabelasPainel.novos')

            </div>

            <!-- Atribuídos -->

            <div class="tab-pane fade show {{ $abaAtiva == 'atribuido-tab' ? 'active' : '' }}" id="atribuido-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <div class="tituloTabelas">

                <h4>Solicitações Atribuídas</h4>

                @include('admin.filtro')
                </div>

                @include('tabelasPainel.atribuidos')

            </div>

            <!-- Aguardando Cirurgiao -->

            <div class="tab-pane fade show {{ $abaAtiva == 'cirurgiao-tab' ? 'active' : '' }}" id="cirurgiao-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <div class="tituloTabelas">

                <h4>Aguardando Edição do Cirurgiao</h4>

                @include('admin.filtro')
                </div>

                @include('tabelasPainel.cirurgiao')

            </div>

            <!-- Aguardando Anestesista -->

            <div class="tab-pane fade show {{ $abaAtiva == 'anestesista-tab' ? 'active' : '' }}" id="anestesista-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <div class="tituloTabelas">

                <h4>Aguardando Edição do Anestesista</h4>

                @include('admin.filtro')
                </div>

                @include('tabelasPainel.anestesista')

            </div>

            <!-- Aguardando Vendedor -->

            <div class="tab-pane fade show {{ $abaAtiva == 'orcamento-tab' ? 'active' : '' }}" id="orcamento-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <div class="tituloTabelas">

                <h4>Aguardando Edição do Responsável</h4>

                @include('admin.filtro')
                </div>

                @include('tabelasPainel.criacao')

            </div>

            <!-- Liberação -->

            <div class="tab-pane fade show {{ $abaAtiva == 'liberacao-tab' ? 'active' : '' }}" id="liberacao-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <div class="tituloTabelas">

                <h4>Aguardando Liberação</h4>

                @include('admin.filtro')
                </div>

                @include('tabelasPainel.liberacao')

            </div>

            <!-- Negociação -->

            <div class="tab-pane fade show {{ $abaAtiva == 'negociacao-tab' ? 'active' : '' }}" id="negociacao-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <div class="tituloTabelas">

                <h4>Orçamentos em Negociação</h4>

                @include('admin.filtro')
                </div>

                @include('tabelasPainel.negociacao')

            </div>

            <!-- Concluídos -->

            <div class="tab-pane fade show {{ $abaAtiva == 'concluidos-tab' ? 'active' : '' }}" id="concluidos-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <div class="tituloTabelas">

                <h4>Orçamentos Finalizados</h4>

                @include('admin.filtro')
                </div>

                @include('tabelasPainel.concluidos')

            </div>

            <!-- Favoritos -->

            <div class="tab-pane fade show {{ $abaAtiva == 'favoritos-tab' ? 'active' : '' }}" id="favoritos-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <div class="tituloTabelas">

                <h4>Marcados como Favorito</h4>

                @include('admin.filtro')
                </div>

                @include('tabelasPainel.favoritos')

            </div>

        </div>



    </div>
</main>

<script>

function toggleFavorite(event, codigoSolicitacao) {
    event.preventDefault();
    fetch(`/favoritar/${codigoSolicitacao}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            let starElement = document.querySelector(`.star-${codigoSolicitacao}`);

            if (data.favorite) {

                starElement.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-star-fill text-warning" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                    </svg>`;
            } else {
                starElement.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-star" viewBox="0 0 16 16">
                        <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                    </svg>`;
            }
        } else {
            alert("Erro ao favoritar.");
        }
    })
    .catch(error => console.error('Erro:', error));
}

</script>

@endsection
