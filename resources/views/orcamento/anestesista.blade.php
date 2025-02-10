@extends('orcamento.layoutsOrcamentos.layoutPadrao')

@section('action', '/orcamento/anestesistaSalvar')



@section('resumo')

@include('orcamento.layoutsOrcamentos.resumoOrcamento')

<div class="d-flex justify-content-end gap-2 mt-3">
<a href="/dashboard" class="btn btn-secondary">Sair sem salvar</a>
<button type="submit" class="btn btn-success">Prosseguir</button>
</div>
</div>
</div>

@endsection



@section('abas')

<style>

.tab-pane.disabled {
    pointer-events: none;
    opacity: 0.8;
}

.tab-pane.disabled .alterar-btn{
background-color:rgb(224, 224, 224);
color: black;
}

.tab-pane.disabled .btn-primary{
background-color:rgb(224, 224, 224);
color: black;
border: black;
}

</style>

    <input type="hidden" name="status" id="status" value="atribuido">

    <li class="nav-item" role="presentation">
        <button class="nav-link" id="solicitacao-tab" data-bs-toggle="tab" data-bs-target="#solicitacao-tab-pane" type="button" role="tab" aria-controls="solicitacao-tab-pane" aria-selected="true">Procedimento</button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link" id="procedimentos-tab" data-bs-toggle="tab" data-bs-target="#procedimentos-tab-pane" type="button" role="tab" aria-controls="procedimentos-tab-pane" aria-selected="false">Cirurgião</button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="anestesista-tab" data-bs-toggle="tab" data-bs-target="#anestesista-tab-pane" type="button" role="tab" aria-controls="anestesista-tab-pane" aria-selected="false">Anestesista</button>
    </li>

@endsection

@section('conteudoAbas')


            <div class="tab-pane fade show align-top text-start row mt-1 disabled" id="solicitacao-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

            @include('orcamento.abasOrcamentos.resumoProcedimento')

            </div>



            <div class="tab-pane fade show disabled" id="procedimentos-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                <h4>Área do Cirurgião</h4>

                @include('orcamento.abasOrcamentos.abaCirurgiao')

                @include('orcamento.abasOrcamentos.procedimento')

            </div>

            <div class="tab-pane fade show active" id="anestesista-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                <h4>Área do Cirurgião</h4>


                @include('orcamento.abasOrcamentos.procedimentoAnestesista')

            </div>

@endsection
