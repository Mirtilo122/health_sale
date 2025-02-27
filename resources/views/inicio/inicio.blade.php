@extends('layouts.main')

@section('titulo', 'Início')

@section('nome_pagina', 'INÍCIO')

@section('conteudo')

<div class="container_inicial">
    <h4>Formulário de Orçamentos</h4>

    <h5 class="mt-5">Quem solicita o orçamento?</h5>

    <button class="btn" onclick="window.location.href='medico';">
        <i class="fas fa-user-md"></i> Médico ou Cirurgião
    </button>
    <button class="btn" onclick="window.location.href='paciente';">
        <i class="fas fa-user"></i> Paciente ou Representante
    </button>
</div>



@endsection


