<div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="align-middle text-center">
                            <a href="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                                </svg>
                            </a>
                        </th>
                        <th scope="col" class="align-middle text-center"><a class="align-middle text-center tittle_table">Número de Protocolo</a></th>
                        <th scope="col" class="align-middle text-center">
                            <a href="{{ route('dashboard.order', ['order_by' => 'nome_solicitante', 'direction' => request()->direction == 'asc' ? 'desc' : 'asc']) }}"
                            class="sortable {{ request()->order_by == 'nome_solicitante' ? (request()->direction == 'asc' ? 'active-asc' : 'active-desc') : '' }}">
                            Solicitante
                            </a>
                        </th>
                        <th scope="col" class="align-middle text-center">
                            <a href="{{ route('dashboard.order', ['order_by' => 'nome_paciente', 'direction' => request()->direction == 'asc' ? 'desc' : 'asc']) }}"
                            class="sortable {{ request()->order_by == 'nome_paciente' ? (request()->direction == 'asc' ? 'active-asc' : 'active-desc') : '' }}">
                            Paciente
                            </a>
                        </th>
                        <th scope="col" class="align-middle text-center"><a class="align-middle text-center tittle_table">Tipo de Orçamento</a></th>
                        <th scope="col" class="align-middle text-center"><a class="align-middle text-center tittle_table">Status</a></th>
                        <th scope="col" class="align-middle text-center"><a class="align-middle text-center tittle_table">Responsável</a></th>
                        <th scope="col" class="align-middle text-center"><a class="align-middle text-center tittle_table">Urgência</a></th>
                        <th scope="col" class="align-middle text-center">
                            <a href="{{ route('dashboard.order', ['order_by' => 'data_solicitacao', 'direction' => request()->direction == 'asc' ? 'desc' : 'asc']) }}"
                            class="sortable {{ request()->order_by == 'data_solicitacao' ? (request()->direction == 'asc' ? 'active-asc' : 'active-desc') : '' }}">
                            Tempo
                            </a>
                        </th>
                        <th scope="col" class="align-middle text-center tittle_table "><a class="align-middle text-center tittle_table">Ações</a></th>
                    </tr>
                </thead>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($solicitacoes->whereIn('status', ['perdido', 'aprovado', 'recusado']) as $solicitacao)
                        <tr>
                            <td scope="row" class="align-middle text-center">
                                <a href="#" onclick="toggleFavorite(event, {{ $solicitacao->codigo_solicitacao }})">
                                    <span class="star-icon star-{{ $solicitacao->codigo_solicitacao }}">
                                        @if(in_array(auth()->id(), json_decode($solicitacao->favoritos, true) ?? []))
                                            <!-- SVG preenchido (favoritado) -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                class="bi bi-star-fill text-warning" viewBox="0 0 16 16">
                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                            </svg>
                                        @else
                                            <!-- SVG vazio (não favoritado) -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                class="bi bi-star" viewBox="0 0 16 16">
                                                <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                                            </svg>
                                        @endif
                                    </span>
                                </a>
                            </td>
                            <td scope="row" class="align-middle text-center">{{ $solicitacao->protocolo }}</td>
                            <td scope="row" class="align-middle text-center">{{ $solicitacao->nome_solicitante }}</td>
                            <td scope="row" class="align-middle text-center">{{ $solicitacao->nome_paciente }}</td>
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
                                    $status = ucfirst(strtolower($solicitacao->status));
                                @endphp
                                @if($status == 'Aprovado')
                                    <span class="badge bg-success text-light">Aprovado</span>
                                @elseif($status == 'Perdido')
                                    <span class="badge bg-danger text-light">Perdido</span>
                                @elseif($status == 'Recusado')
                                    <span class="badge bg-dark text-light">Recusado</span>
                                @endif

                            </td>
                            <td scope="row" class="align-middle text-center">

                                @php
                                    $responsavel = $solicitacao->responsavel ? $solicitacao->responsavel->usuario : 'Sem responsável';
                                @endphp

                                {{ $responsavel }}

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
                            <td scope="row" class="align-middle text-center">
                                @php
                                    $diferenca = \Carbon\Carbon::parse($solicitacao->data_concluido)->diffForHumans();
                                @endphp
                                {{ $diferenca }}
                            </td>
                            <td scope="row" class="align-middle text-center">
                            <a href="{{ route('orcamento.concluido', $solicitacao->codigo_solicitacao) }}" class="btn btn-secondary btn-sm" style=" width: 100%; --bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Visualizar</a>
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



