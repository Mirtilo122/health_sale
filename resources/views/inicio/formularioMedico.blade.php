@extends('layouts.formulario')

@section('titulo', 'Formulário Médico')

@section('nomeForm', 'Formulário de solicitação por Médico ou Cirurgião')

@section('tipo')
    <input type="hidden" name="formulario" value="medico">
@endsection


@section('cirurgiao')
    <div class="d-none" id="dadosCirurgiao">
        <h3>Dados do Cirurgião</h3>
        <label for="nomeCirurgiao">Nome Completo</label>
        <input type="text" id="nomeCirurgiao" name="nomeCirurgiao">

        <label for="crmCirurgiao">CRM</label>
        <input type="crmCirurgiao" id="crmCirurgiao" name="crmCirurgiao">
    </div>
@endsection



@section('descDetalhe')
    <label for="descDetalhada">Descrição Detalhada do Procedimento</label>
    <textarea id="descDetalhada" name="descDetalhada"></textarea>
@endsection


@section('maisInfo')
    <label for="tempoCirurgico">Tempo Cirúrgico Previsto (em horas)</label>
    <input type="number" id="tempoCirurgico" name="tempoCirurgico" min="0" step="0.5">

    <div>
        <h3>Definição das Acomodações</h3>

        <label for="enfermaria">Enfermaria (Quantas diárias)</label>
        <input type="number" id="enfermaria" name="enfermaria" min="0">

        <label for="apartamento">Apartamento (Quantas diárias)</label>
        <input type="number" id="apartamento" name="apartamento" min="0">

        <label for="utiAdulto">UTI Adulto (Quantas diárias)</label>
        <input type="number" id="utiAdulto" name="utiAdulto" min="0">
    </div> <br>

    <div>
        <h3>Anestesia</h3>

        <label><input type="checkbox" name="anestesia[]" value="raqui"> Raqui</label><br>
        <label><input type="checkbox" name="anestesia[]" value="sma"> SMA</label><br>
        <label><input type="checkbox" name="anestesia[]" value="peridural"> Peridural</label><br>
        <label><input type="checkbox" name="anestesia[]" value="sedacao"> Sedação</label><br>
        <label><input type="checkbox" name="anestesia[]" value="externo"> Externo</label><br>
        <label><input type="checkbox" name="anestesia[]" value="bloqueio"> Bloqueio</label><br>
        <label><input type="checkbox" name="anestesia[]" value="local"> Local</label><br>
        <label>
            <input type="checkbox" name="anestesia[]" value="outros"> Outros:
            <input type="text" id="anestesiaOutros" name="anestesiaOutros" placeholder="Especifique">
        </label>
    </div> <br>
@endsection






