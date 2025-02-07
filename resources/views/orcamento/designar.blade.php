@extends('orcamento.layoutsOrcamentos.layoutPadrao')

@section('action', '/orcamento/salvar')

@section('abas')

    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="paciente-tab" data-bs-toggle="tab" data-bs-target="#paciente-tab-pane" type="button" role="tab" aria-controls="paciente-tab-pane" aria-selected="true">Paciente</button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link" id="solicitacao-tab" data-bs-toggle="tab" data-bs-target="#solicitacao-tab-pane" type="button" role="tab" aria-controls="solicitacao-tab-pane" aria-selected="false">Solicitação</button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link" id="procedimentos-tab" data-bs-toggle="tab" data-bs-target="#procedimentos-tab-pane" type="button" role="tab" aria-controls="procedimentos-tab-pane" aria-selected="false">Procedimentos</button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link" id="equipe-tab" data-bs-toggle="tab" data-bs-target="#equipe-tab-pane" type="button" role="tab" aria-controls="equipe-tab-pane" aria-selected="false">Equipe</button>
    </li>

@endsection

@section('conteudoAbas')

            <!-- Paciente -->

            <div class="tab-pane fade show active align-top text-start row mt-1" id="paciente-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

            @include('orcamento.abasOrcamentos.infoPaciente')

            </div>

            <!-- Solicitação -->

            <div class="tab-pane fade show" id="solicitacao-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

            @include('orcamento.abasOrcamentos.infoSolicitacao')

            </div>

            <!-- Procedimentos -->

            <div class="tab-pane fade show" id="procedimentos-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                <h4>Procedimentos</h4>

                @include('orcamento.abasOrcamentos.procedimento')

            </div>

            <!-- Equipe -->

            <div class="tab-pane fade show" id="equipe-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                <h4>Equipe</h4>

                @include('orcamento.abasOrcamentos.montarEquipe')


            </div>
@endsection








