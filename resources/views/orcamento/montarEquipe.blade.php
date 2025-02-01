@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Atribuir Usuários ao Orçamento</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('orcamento.salvar') }}">
        @csrf
        <input type="hidden" name="solicitacao_id" value="{{ $solicitacao->id }}">

        <div class="mb-3">
            <label for="cirurgiao" class="form-label">Cirurgião</label>
            <select name="cirurgiao" id="cirurgiao" class="form-control" required>
                <option value="">Selecione um cirurgião</option>
                @foreach($cirurgioes as $cirurgiao)
                    <option value="{{ $cirurgiao->id }}">{{ $cirurgiao->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="anestesista" class="form-label">Anestesista</label>
            <select name="anestesista" id="anestesista" class="form-control" required>
                <option value="">Selecione um anestesista</option>
                @foreach($anestesistas as $anestesista)
                    <option value="{{ $anestesista->id }}">{{ $anestesista->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="agentes_edicao" class="form-label">Agentes (Edição)</label>
            <select name="agentes_edicao[]" id="agentes_edicao" class="form-control" multiple>
                @foreach($agentes as $agente)
                    <option value="{{ $agente->id }}">{{ $agente->name }}</option>
                @endforeach
            </select>
            <small class="text-muted">Mantenha em branco se não houver agentes para edição.</small>
        </div>

        <div class="mb-3">
            <label for="agentes_visualizacao" class="form-label">Agentes (Visualização)</label>
            <select name="agentes_visualizacao[]" id="agentes_visualizacao" class="form-control" multiple>
                @foreach($agentes as $agente)
                    <option value="{{ $agente->id }}">{{ $agente->name }}</option>
                @endforeach
            </select>
            <small class="text-muted">Mantenha em branco se não houver agentes para visualização.</small>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
@endsection
