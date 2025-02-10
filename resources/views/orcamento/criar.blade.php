@extends('orcamento.layoutsOrcamentos.layoutPadrao')

@section('action', '/orcamento/criarSalvar')



@section('resumo')

@include('orcamento.layoutsOrcamentos.resumoOrcamento')
<div class="d-flex justify-content-end gap-2 mt-3">
<a href="/dashboard" class="btn btn-secondary">Sair sem salvar</a>
<button type="submit" class="btn btn-primary" id="salvarSair">Salvar e Sair</button>
<button type="submit" class="btn btn-success" id="criar">Criar Orçamento</button>
</div>
</div>
</div>

@endsection



@section('abas')

    <input type="hidden" name="status" id="status" value="criacao">


    <li class="nav-item" role="presentation">
        <button class="nav-link" id="solicitacao-tab" data-bs-toggle="tab" data-bs-target="#solicitacao-tab-pane" type="button" role="tab" aria-controls="solicitacao-tab-pane" aria-selected="false">Solicitação</button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link" id="procedimentos-tab" data-bs-toggle="tab" data-bs-target="#procedimentos-tab-pane" type="button" role="tab" aria-controls="procedimentos-tab-pane" aria-selected="false">Procedimentos</button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link" id="equipe-tab" data-bs-toggle="tab" data-bs-target="#equipe-tab-pane" type="button" role="tab" aria-controls="equipe-tab-pane" aria-selected="false">Manutenção de Equipe</button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="criar-tab" data-bs-toggle="tab" data-bs-target="#criar-tab-pane" type="button" role="tab" aria-controls="criar-tab-pane" aria-selected="false">Outras Informações</button>
    </li>

@endsection

@section('conteudoAbas')


            <div class="tab-pane fade show  align-top text-start row mt-1" id="solicitacao-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

            @include('orcamento.abasOrcamentos.resumoProcedimento')

            </div>


            <div class="tab-pane fade show" id="procedimentos-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                <h4>Procedimentos</h4>

                @include('orcamento.abasOrcamentos.procedimento')

            </div>

            <div class="tab-pane fade show" id="equipe-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                <h4>Equipe</h4>

                @include('orcamento.abasOrcamentos.montarEquipe')


            </div>


            <div class="tab-pane fade show active" id="criar-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                <h4>Condições Gerais</h4>

                <div class="mb-3">
                            <label for="formFile" class="form-label">Anexo</label>
                            <input class="form-control" type="file" id="arquivo_condicoes" name="arquivo_condicoes">
                </div>

            </div>
@endsection








