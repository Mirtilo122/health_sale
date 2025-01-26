@extends('layouts.main')

@section('titulo', 'Início')

@section('conteudo')


<main>
<h1>Formulário de Orçamentos</h1>

<h3>Quem solicita o orçamento?</h3>

<button class="btn" onclick="window.location.href='medico';">
    <i class="fas fa-user-md"></i> Médico ou Cirurgião
</button>
<button class="btn" onclick="window.location.href='paciente';">
    <i class="fas fa-user"></i> Paciente ou Representante
</button>

<a href="admin/login">Painel</a>
</main>

@endsection
