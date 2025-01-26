@extends('layouts.admin')

@section('titulo', 'Painel Administrativo')

@section('nome_pagina', 'INÍCIO')

@section('conteudo')


<main>

    <div class="container">
        <h2 class="text-center my-4">Solicitações de Orçamento</h2>

        {{$selected_status = ''}}

        <!-- Filtro -->
        <div class="filter-section mb-4">
            <form method="get" action="{{ url('dashboard.filter') }}" class="row align-items-center">
                <div class="col-md-9">
                    <label for="status" class="form-label">Filtrar por Status:</label>
                    <select name="status" id="status" class="form-select">
                        <option value="">Todos</option>
                        <option value="pendente" {{ $selected_status === 'pendente' ? 'selected' : '' }}>Pendente</option>
                        <option value="aguardando" {{ $selected_status === 'aguardando' ? 'selected' : '' }}>Aguardando</option>
                        <option value="negociação" {{ $selected_status === 'negociação' ? 'selected' : '' }}>Negociação</option>
                        <option value="cancelado" {{ $selected_status === 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                        <option value="aprovado" {{ $selected_status === 'aprovado' ? 'selected' : '' }}>Aprovado</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex justify-content-center justify-content-md-start">
                <button type="submit" class="btn btn-primary" style="height: 100%; width: auto; aspect-ratio: 1;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel" viewBox="0 0 16 16">
                            <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2z"/>
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <!-- Tabela de Solicitações -->
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-primary">
                    <tr>
                        <th scope="col" class="align-middle text-center"><a href="{{ route('dashboard.order', ['order_by' => 'nome_solicitante', 'direction' => request()->direction == 'asc' ? 'desc' : 'asc']) }} " class="text-start">Solicitante</a></th>
                        <th scope="col" class="align-middle text-center"><a href="{{ route('dashboard.order', ['order_by' => 'nome_paciente', 'direction' => request()->direction == 'asc' ? 'desc' : 'asc']) }}" class="text-start">Paciente</a></th>
                        <th scope="col" class="align-middle text-center">Tipo de Orçamento</th>
                        <th scope="col" class="align-middle text-center">Status</th>
                        <th scope="col" class="align-middle text-center">Urgência</th>
                        <th scope="col" class="align-middle text-center">Horário de Solicitação</th>
                        <th scope="col" class="align-middle text-center"><a href="{{ route('dashboard.order', ['order_by' => 'data_solicitacao', 'direction' => request()->direction == 'asc' ? 'desc' : 'asc']) }}" class="text-start">Tempo desde a Solicitação</a></th>
                        <th scope="col" class="align-middle text-center">Ações</th>
                    </tr>
                </thead>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($solicitacoes as $solicitacao)
                        <tr>
                            <td scope="row">{{ $solicitacao->nome_solicitante }}</td>
                            <td scope="row">{{ $solicitacao->nome_paciente }}</td>
                            <td scope="row" class="align-middle text-center">
                                @php
                                    $tipoOrcamento = ucfirst(strtolower($solicitacao->tipo_orcamento));
                                @endphp
                                @if($tipoOrcamento == 'cirurgia')
                                    Cirurgia
                                @elseif($tipoOrcamento == 'parto')
                                    Parto
                                @else
                                    {{ $tipoOrcamento }}
                                @endif
                            </td>
                            <td scope="row" class="align-middle text-center">
                                @php
                                    $statusClass = match (strtolower($solicitacao->status)) {
                                        'pendente' => 'bg-secondary text-dark',
                                        'aguardando' => 'bg-warning text-dark',
                                        'negociação' => 'bg-primary text-white',
                                        'cancelado' => 'bg-danger text-white',
                                        'aprovado' => 'bg-success text-white',
                                        default => '',
                                    };
                                @endphp
                                <span class="badge {{ $statusClass }}">{{ ucfirst($solicitacao->status) }}</span>
                            </td>
                            <td scope="row" class="align-middle text-center">
                                @if ($solicitacao->urgencia)
                                    <div class="text-danger d-flex align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="urgent-icon bi bi-exclamation-triangle" viewBox="0 0 16 16">
                                            <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z"/>
                                            <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
                                        </svg>
                                        <span>Urgente</span>
                                    </div>
                                @endif
                            </td>
                            <td scope="row" class="align-middle text-center">{{ \Carbon\Carbon::parse($solicitacao->data_solicitacao)->format('d/m/y H:i') }}</td>
                            <td scope="row" class="align-middle text-center">
                                @php
                                    $diferenca = \Carbon\Carbon::parse($solicitacao->data_solicitacao)->diffForHumans();
                                @endphp
                                {{ $diferenca }}
                            </td>
                            <td scope="row" class="align-middle text-center">
                                @switch(strtolower($solicitacao->status))
                                    @case('pendente')
                                        <a href="{{ route('orcamento.atribuir', ['codigo_solicitacao' => $solicitacao->codigo_solicitacao]) }}" class="btn btn-secondary btn-sm" style=" width: 100%; --bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Detalhes</a>
                                        @break
                                    @case('aguardando')
                                        <a href="{{ url('criar_orcamentos', ['codigo_solicitacao' => $solicitacao->codigo_solicitacao]) }}" class="btn btn-warning btn-sm" style="width: 100%;--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Criar</a>
                                        @break
                                    @case('negociação')
                                        <a href="{{ url('visualizar_orcamento', ['codigo_solicitacao' => $solicitacao->codigo_solicitacao]) }}" class="btn btn-info btn-sm">Visualizar</a>
                                        <a href="{{ url('editar_orcamento', ['codigo_solicitacao' => $solicitacao->codigo_solicitacao]) }}" class="btn btn-primary btn-sm">Editar</a>
                                        @break
                                    @case('cancelado')
                                    @case('aprovado')
                                        <a href="{{ url('visualizar_orcamento', ['codigo_solicitacao' => $solicitacao->codigo_solicitacao]) }}" class="btn btn-success btn-sm">Visualizar</a>
                                        @break
                                @endswitch
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Nenhuma solicitação de orçamento encontrada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>
<script src="/js/script.js"></script>

@endsection
