@extends('layouts.app')

@section('content')
    <div class="alert alert-danger">
        <h4 class="alert-heading">Ação não permitida</h4>
        <p>O orçamento não está na etapa necessária para realizar esta ação. Por favor, verifique o status do orçamento e tente novamente.</p>
    </div>

    <!-- Botão de Sair -->
    <div class="text-center mt-4">
        <a href="/dashboard" class="btn btn-secondary btn-sm">Sair</a>
    </div>
@endsection
