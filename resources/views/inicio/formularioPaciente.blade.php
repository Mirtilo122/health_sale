@extends('layouts.formulario')


@section('titulo', 'Formulário Paciente')

@section('nomeForm', 'Formulário de solicitação por Paciente ou Responsável')

@section('tipo')
    <input class="d-none" name="formulario" value="paciente">
@endsection


@section('cirurgiao')
    <div class="d-none" id="dadosCirurgiao">
        <h3>Dados do Cirurgião</h3>
        <label for="nomeCirurgiao">Nome Completo</label>
        <input type="text" id="nomeCirurgiao" name="nomeCirurgiao">
    </div>
@endsection

