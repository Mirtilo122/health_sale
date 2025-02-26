@extends('orcamento.layoutsOrcamentos.layoutPadrao')

@section('action', '/orcamento/criarSalvar')



@section('resumo')

<a href="/dashboard" class="btn btn-secondary btn-sm">Sair sem salvar</a>
<button type="submit" class="btn btn-primary btn-sm" id="salvarSair">Salvar e Sair</button>
<button type="submit" class="btn btn-success btn-sm" id="criar" onclick="prepararEnvio('criar')">Criar Orçamento</button>
</div>
</div>
</div>


@endsection



@section('abas')

    <input type="hidden" name="tipo_data" id="tipo_data" value="data_liberacao">
    <input type="hidden" name="aba_ativa" id="aba_ativa" value="orcamento-tab">
    <input type="hidden" id="orcamento_emitido" name="orcamento_emitido" value='0'>


    <li class="nav-item" role="presentation">
        <button class="nav-link" id="procedimento-tab" data-bs-toggle="tab" data-bs-target="#procedimento-tab-pane" type="button" role="tab" aria-controls="procedimento-tab-pane" aria-selected="false">Procedimento</button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link" id="cirurgiao-tab" data-bs-toggle="tab" data-bs-target="#cirurgiao-tab-pane" type="button" role="tab" aria-controls="cirurgiao-tab-pane" aria-selected="false">Cirurgião</button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link" id="anestesista-tab" data-bs-toggle="tab" data-bs-target="#anestesista-tab-pane" type="button" role="tab" aria-controls="anestesista-tab-pane" aria-selected="false">Anestesista</button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="hospital-tab" data-bs-toggle="tab" data-bs-target="#hospital-tab-pane" type="button" role="tab" aria-controls="hospital-tab-pane" aria-selected="false">Hospital</button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link" id="condicoes-tab" data-bs-toggle="tab" data-bs-target="#condicoes-tab-pane" type="button" role="tab" aria-controls="condicoes-tab-pane" aria-selected="false">Condições Gerais</button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link" id="manutencao-tab" data-bs-toggle="tab" data-bs-target="#manutencao-tab-pane" type="button" role="tab" aria-controls="manutencao-tab-pane" aria-selected="false">Manutenção</button>
    </li>


@endsection

@section('conteudoAbas')


            <div class="tab-pane fade show align-top text-start mt-1" id="procedimento-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

            @include('orcamento.abasOrcamentos.resumoProcedimento')

            </div>


            <div class="tab-pane fade show" id="cirurgiao-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                @include('orcamento.abasOrcamentos.abaCirurgiao')

            </div>

            <div class="tab-pane fade show" id="anestesista-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                 @include('orcamento.abasOrcamentos.abaAnestesia')

            </div>


            <div class="tab-pane fade show  align-top text-start mt-1 active" id="hospital-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                <h4 class="mb-4">Diárias, Taxas e Visitas Hospital</h4>

                @include('orcamento.abasOrcamentos.procedimento')

            </div>


            <div class="tab-pane fade show" id="condicoes-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                @include('orcamento.abasOrcamentos.condicoesGerais')

            </div>


            <div class="tab-pane fade show align-top text-start mt-1" id="manutencao-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                @include('orcamento.abasOrcamentos.manutencao')
                @include('orcamento.abasOrcamentos.montarEquipe')

            </div>

@endsection








