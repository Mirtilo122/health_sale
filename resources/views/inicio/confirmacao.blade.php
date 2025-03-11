@extends('layouts.main')

@section('titulo', 'Confirmação de Envio')

@section('nome_pagina', 'CONFIRMAÇÃO')

@section('conteudo')
<div class="container_inicial">
    <div class="confirmation-container">
        <div class="alert alert-success" role="alert">
            Formulário enviado com sucesso!
        </div>

        <h1>Solicitante:</h1>
        <p>{{ session('nome_solicitante') }}</p>

        <h1>Paciente:</h1>
        <p>{{ session('nome_paciente') }}</p>

        <div class="protocolo-info">
            <h1>Número de Protocolo:</h1>
            <p>{{ session('protocolo') }}</p>
            <div class="alert alert-warning" role="alert">
                Atenção! Guarde o número de protocolo para acompanhar o seu orçamento!
            </div>
        </div>

        <p class="texto_informativo text-success">Entraremos em contato em até 5 horas no horário comercial, sujeitas à variações após expediente ou em feriados.</p>

        <a href="inicio" class="btn btn-primary">Voltar à Página Inicial</a>
    </div>
</div>
@endsection
