@extends('layouts.admin')

@section('titulo', 'Painel Administrativo')

@section('nome_pagina', 'INÍCIO')

@section('conteudo')


<main>

    <div class="container">
        <h2 class="text-center my-4">Solicitações de Orçamento</h2>


        <ul class="nav nav-tabs" id="myTab" role="tablist">

            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="novos-tab" data-bs-toggle="tab" data-bs-target="#novos-tab-pane" type="button" role="tab" aria-controls="novos-tab-pane" aria-selected="true">Novas</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="atribuido-tab" data-bs-toggle="tab" data-bs-target="#atribuido-tab-pane" type="button" role="tab" aria-controls="atribuido-tab-pane" aria-selected="false">Atribuídas</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="cirurgiao-tab" data-bs-toggle="tab" data-bs-target="#cirurgiao-tab-pane" type="button" role="tab" aria-controls="cirurgiao-tab-pane" aria-selected="false">Aguardando Cirurgião</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="anestesista-tab" data-bs-toggle="tab" data-bs-target="#anestesista-tab-pane" type="button" role="tab" aria-controls="anestesista-tab-pane" aria-selected="false">Aguardando Anestesista</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="orcamento-tab" data-bs-toggle="tab" data-bs-target="#orcamento-tab-pane" type="button" role="tab" aria-controls="orcamento-tab-pane" aria-selected="false">Finalizando Orçamento</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="liberacao-tab" data-bs-toggle="tab" data-bs-target="#liberacao-tab-pane" type="button" role="tab" aria-controls="liberacao-tab-pane" aria-selected="false">Liberação</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="negociacao-tab" data-bs-toggle="tab" data-bs-target="#negociacao-tab-pane" type="button" role="tab" aria-controls="negociacao-tab-pane" aria-selected="false">Negociação</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="concluidos-tab" data-bs-toggle="tab" data-bs-target="#concluidos-tab-pane" type="button" role="tab" aria-controls="concluidos-tab-pane" aria-selected="false">Concluídas</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="favoritos-tab" data-bs-toggle="tab" data-bs-target="#favoritos-tab-pane" type="button" role="tab" aria-controls="favoritos-tab-pane" aria-selected="false">Favoritas</button>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">

            <!-- Novos -->

            <div class="tab-pane  fade show active align-top text-start" id="novos-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                <h4>Novas Solicitações</h4>

                @include('admin.filtro')

                @include('tabelasPainel.novos')

            </div>

            <!-- Atribuídos -->

            <div class="tab-pane fade show" id="atribuido-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                <h4>Solicitações Atribuídas</h4>

                @include('admin.filtro')

                @include('tabelasPainel.atribuidos')

            </div>

            <!-- Aguardando Cirurgiao -->

            <div class="tab-pane fade show" id="cirurgiao-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                <h4>Aguardando Edição do Cirurgiao</h4>

                @include('admin.filtro')

                @include('tabelasPainel.cirurgiao')

            </div>

            <!-- Aguardando Anestesista -->

            <div class="tab-pane fade show" id="anestesista-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                <h4>Aguardando Edição do Anestesista</h4>

                @include('admin.filtro')

                @include('tabelasPainel.anestesista')

            </div>

            <!-- Aguardando Vendedor -->

            <div class="tab-pane fade show" id="orcamento-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                <h4>Aguardando Edição do Responsável</h4>

                @include('admin.filtro')

                @include('tabelasPainel.criacao')

            </div>

            <!-- Liberação -->

            <div class="tab-pane fade show" id="liberacao-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                <h4>Aguardando Liberação</h4>

                @include('admin.filtro')

                @include('tabelasPainel.liberacao')

            </div>

            <!-- Negociação -->

            <div class="tab-pane fade show" id="negociacao-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                <h4>Orçamentos em Negociação</h4>

                @include('admin.filtro')

                @include('tabelasPainel.negociacao')

            </div>

            <!-- Concluídos -->

            <div class="tab-pane fade show" id="concluidos-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                <h4>Orçamentos Finalizados</h4>

                @include('admin.filtro')

                @include('tabelasPainel.concluidos')

            </div>

            <!-- Favoritos -->

            <div class="tab-pane fade show" id="favoritos-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                <h4>Marcados como Favorito</h4>

                @include('admin.filtro')

                @include('tabelasPainel.favoritos')

            </div>

        </div>



    </div>
</main>
<script src="/js/script.js"></script>
<script>

function toggleFavorite(event, codigoSolicitacao) {
    event.preventDefault(); // Evita redirecionamento da página

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
                // Substitui pelo SVG preenchido (favoritado)
                starElement.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-star-fill text-warning" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                    </svg>`;
            } else {
                // Substitui pelo SVG vazio (não favoritado)
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
