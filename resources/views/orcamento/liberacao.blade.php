@extends('orcamento.layoutsOrcamentos.layoutPadrao')

@section('action', '/orcamento/liberar')



@section('resumo')

@include('orcamento.layoutsOrcamentos.resumoOrcamento')
<div class="d-flex justify-content-end gap-2 mt-3">
<button type="submit" class="btn btn-danger" id="recusar">Recusar</button>
<a href="/dashboard" class="btn btn-secondary">Sair sem salvar</a>
<button type="submit" class="btn btn-primary" id="liberar">Liberar</button>
<button type="submit" class="btn btn-success" id="salvarSair">Salvar e Sair</button>
</div>
</div>
</div>

@endsection



@section('abas')




    <li class="nav-item" role="presentation">
        <button class="nav-link" id="solicitacao-tab" data-bs-toggle="tab" data-bs-target="#solicitacao-tab-pane" type="button" role="tab" aria-controls="solicitacao-tab-pane" aria-selected="false">Procedimentos</button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link" id="procedimentos-tab" data-bs-toggle="tab" data-bs-target="#procedimentos-tab-pane" type="button" role="tab" aria-controls="procedimentos-tab-pane" aria-selected="false">Hospital</button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link" id="equipe-tab" data-bs-toggle="tab" data-bs-target="#equipe-tab-pane" type="button" role="tab" aria-controls="equipe-tab-pane" aria-selected="false">Manutenção de Equipe</button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="criar-tab" data-bs-toggle="tab" data-bs-target="#criar-tab-pane" type="button" role="tab" aria-controls="criar-tab-pane" aria-selected="false">Condições Gerais</button>
    </li>

@endsection

@section('conteudoAbas')


            <div class="tab-pane fade show  align-top text-start row mt-1" id="solicitacao-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

            @include('orcamento.abasOrcamentos.resumoProcedimento')

            <br>

            <p><strong>Alterar Status:</strong></p>


            <select name="status" id="status">
                <option value="novo" {{ $solicitacao->status == "novo" ? 'selected' : '' }}>Novo</option>
                <option value="atribuido" {{ $solicitacao->status == "atribuido" ? 'selected' : '' }}>Atribuída</option>
                <option value="cirurgiao" {{ $solicitacao->status == "cirurgiao" ? 'selected' : '' }}>Retorno Cirurgião</option>
                <option value="anestesista" {{ $solicitacao->status == "anestesista" ? 'selected' : '' }}>Retorno Anestesista</option>
                <option value="criacao" {{ $solicitacao->status == "criacao"  ? 'selected' : '' }}>Retorno Responsável</option>
                <option value="liberacao" {{ $solicitacao->status == "liberacao"  ? 'selected' : '' }}>Em Liberação</option>
                <option value="negociacao" {{ $solicitacao->status == "negociacao"  ? "negociacao" : '' }}>Em Negociação</option>
                <option value="aprovado" {{ $solicitacao->status == "aprovado" ? "aprovado" : '' }}>Aprovado</option>
                <option value="perdido" {{ $solicitacao->status =="perdido" ? 'selected' : '' }}>Perdido</option>
                <option value="recusado" {{ $solicitacao->status == "recusado" ? 'selected' : '' }}>Recusado</option>
            </select>


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

                <div class="info  p-2 rounded" style="font-size: 1rem;">
                <h5><strong>Arquivo:</strong></h5>
                @if(is_null($solicitacao->arquivo_pdf))
                    <p class="text-danger">Anexo não foi enviado</p>
                @else
                    @php
                        $caminhoArquivo = asset($solicitacao->arquivo_pdf);
                    @endphp
                    <a href="{{ $caminhoArquivo }}" class="btn btn-primary" download>Baixar Arquivo</a>
                @endif
                </div>

                <div class="mb-3">
                            <label for="formFile" class="form-label">Anexar Novo:</label>
                            <input class="form-control" type="file" id="arquivo_condicoes" name="arquivo_condicoes">
                </div>



            </div>
@endsection








