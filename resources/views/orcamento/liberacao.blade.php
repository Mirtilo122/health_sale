@extends('orcamento.layoutsOrcamentos.layoutPadrao')

@section('action', '/orcamento/liberar')



@section('resumo')

<button type="submit" class="btn btn-danger btn-sm" onclick="prepararEnvio('recusar')">Recusar</button>
<a href="/dashboard" class="btn btn-secondary btn-sm">Sair sem salvar</a>
<button type="submit" class="btn btn-primary btn-sm" onclick="prepararEnvio('liberar')">Liberar</button>
<button type="submit" class="btn btn-success btn-sm">Salvar e Sair</button>
</div>
</div>
</div>

@endsection



@section('abas')

    <input type="hidden" name="tipo_data" id="tipo_data" value="data_negociacao">


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

            <div class="tab-pane fade show align-top text-start mt-1" id="manutencao-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                @include('orcamento.abasOrcamentos.montarEquipe')

                <p><strong>Alterar Status:</strong></p>


                <select name="status" id="status">
                    <option value="novo" {{ $solicitacao->status == "novo" ? 'selected' : '' }}>Novo</option>
                    <option value="atribuido" {{ $solicitacao->status == "atribuido" ? 'selected' : '' }}>Atribuída</option>
                    <option value="cirurgiao" {{ $solicitacao->status == "cirurgiao" ? 'selected' : '' }}>Retorno Cirurgião</option>
                    <option value="anestesista" {{ $solicitacao->status == "anestesista" ? 'selected' : '' }}>Retorno Anestesista</option>
                    <option value="criacao" {{ $solicitacao->status == "criacao"  ? 'selected' : '' }}>Retorno Responsável</option>
                    <option value="liberacao" {{ $solicitacao->status == "liberacao"  ? 'selected' : '' }}>Em Liberação</option>
                    <option value="negociacao" {{ $solicitacao->status == "negociacao"  ? "selected" : '' }}>Em Negociação</option>
                    <option value="aprovado" {{ $solicitacao->status == "aprovado" ? "selected" : '' }}>Aprovado</option>
                    <option value="perdido" {{ $solicitacao->status =="perdido" ? 'selected' : '' }}>Perdido</option>
                    <option value="recusado" {{ $solicitacao->status == "recusado" ? 'selected' : '' }}>Recusado</option>
                </select>

            </div>
@endsection








