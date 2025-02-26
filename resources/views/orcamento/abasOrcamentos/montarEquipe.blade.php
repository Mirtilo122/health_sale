<div class="row mt-1 d-flex">
    <input type="hidden" id="agentesEditarDesignadosLoad"
       value='{{ old("agentesEnviados", $orcamento->id_usuarios_editar ?? "[]") }}'>

    <input type="hidden" id="agentesVisualizarDesignadosLoad"
       value='{{ old("agentesEnviados", $orcamento->id_usuarios_visualizar ?? "[]") }}'>

    <input type="hidden" name="agentesEnviados" id="agentesEnviadosInput">

    <!-- Cirurgião -->
    <div class="col-md-4 border-end border-grey">
        <div class="mb-3">
            <label for="id_usuarios_cirurgioes" class="form-label">Cirurgião</label>
            <select name="id_usuarios_cirurgioes" id="id_usuarios_cirurgioes" class="form-control" required>
                <option value="">Selecione um cirurgião</option>
                @foreach($cirurgioes as $cirurgiao)
                    <option value="{{ $cirurgiao->id }}"
                        {{ $idCirurgiaoSelecionado == $cirurgiao->id ? 'selected' : '' }}>
                        {{ $cirurgiao->usuario }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <h5>Informações do Cirurgião:</h5>
        </div>
    </div>

    <!-- Anestesista -->
    <div class="col-md-4 border-end border-grey">
        <div class="mb-3">
            <label for="id_usuarios_anestesistas" class="form-label">Anestesista</label>
            <select name="id_usuarios_anestesistas" id="id_usuarios_anestesistas" class="form-control" required>
                <option value="">Selecione um anestesista</option>
                @foreach($anestesistas as $anestesista)
                    <option value="{{ $anestesista->id }}"
                        {{ $idAnestesistaSelecionado == $anestesista->id ? 'selected' : '' }}>
                        {{ $anestesista->usuario }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <h5>Informações do Anestesista:</h5>
        </div>
    </div>

    <!-- Agentes -->
    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">Agentes</label>
            <button type="button" class="btn btn-primary" id="add-agente">Selecionar Novo Agente</button>
            <select id="agente-selecao" class="form-control mt-2">
                <option value="" disabled selected>Escolha um agente</option>
                @foreach($agentes as $agente)
                    <option value="{{ $agente->id }}"
                        @if($agente->id === $solicitacao->id_usuario || in_array($agente->id, $idsVisualizar) || in_array($agente->id, $idsEditar)) disabled style="color: gray;" @endif>
                        {{ $agente->usuario }}
                        @if($agente->id === $solicitacao->id_usuario) (Responsável) @endif
                    </option>
                @endforeach
            </select>
        </div>



        <ul id="lista-agentes" class="list-group mt-3">
            @if($solicitacao->responsavel)
                <li class="list-group-item d-flex justify-content-between align-items-center" id="agente-{{$solicitacao->id_usuario}}">
                    <div class="agente-nome" style="color: gray;">{{ $solicitacao->responsavel->usuario }}</div>
                    <div class="agente-switch">
                        <span>Responsável</span>
                    </div>
                    <div>
                        <button type="button" class="btn btn-warning mt-1" data-bs-toggle="modal" data-bs-target="#modalAlterarResponsavel">
                            Alterar Responsável
                        </button>
                    </div>
                    <div class="agente-actions">
                    </div>
                    <input type="hidden" id="id_usuario_responsavel" name="id_usuario_responsavel" value="{{$solicitacao->id_usuario}}">
                </li>
            @endif

            @foreach($agentes as $agente)
                @if(in_array($agente->id, $idsVisualizar) || in_array($agente->id, $idsEditar))
                    <li class="list-group-item d-flex justify-content-between align-items-center" id="agente-{{ $agente->id }}">
                        <div class="agente-nome" style="color: gray;">{{ $agente->usuario }}</div>
                        <div class="agente-switch">
                            <div class="form-check form-switch d-flex align-items-center">
                                <input class="form-check-input" type="checkbox"
                                    name="agentes[{{ $agente->id }}]"
                                    data-agente-id="{{ $agente->id }}"
                                    {{ in_array($agente->id, $idsEditar) ? 'checked' : '' }}>
                                <label class="ms-2">{{ in_array($agente->id, $idsEditar) ? 'Editar' : 'Visualizar' }}</label>
                            </div>
                        </div>
                        <div class="agente-actions">
                            <button type="button" class="btn btn-danger btn-sm ms-2 remove-agente" onclick="removerAgente({{$agente->id}})">Remover</button>
                        </div>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>

    <div class="modal fade" id="modalAlterarResponsavel" tabindex="-1" aria-labelledby="modalAlterarResponsavelLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAlterarResponsavelLabel">Alterar Responsável</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <label for="novo-responsavel" class="form-label">Selecione o novo responsável</label>
                    <select id="novo-responsavel" class="form-control">
                        @foreach($agentes as $agente)
                            <option value="{{ $agente->id }}">
                                {{ $agente->usuario }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="confirmar-novo-responsavel">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
</div>


