<h4>Informações da Equipe</h4><br>
<div class="row mt-1 d-flex">

    <input type="hidden" id="id_usuario_responsavel" name="id_usuario_responsavel" value="{{$solicitacao->id_usuario}}">

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
    </div>

    <!-- Agentes -->
    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">Agentes</label>
            <button type="button" class="btn btn-primary" id="add-agente">Selecionar Novo Agente</button>
            <select id="agente-selecao" class="form-control mt-2">
                <option value="" disabled selected>Escolha um agente</option>
                @foreach($agentes as $agente)
                    @if($agente->id !== $solicitacao->id_usuario)
                        <option value="{{ $agente->id }}"
                            @if(in_array($agente->id, $idsVisualizar) || in_array($agente->id, $idsEditar)) disabled style="color: gray;" @endif>
                            {{ $agente->usuario }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>

        <ul id="lista-agentes" class="list-group mt-3">
            <!-- Lista de agentes carregados do banco de dados -->
            @foreach($agentes as $agente)
                @if(in_array($agente->id, $idsVisualizar) || in_array($agente->id, $idsEditar))
                    <li class="list-group-item d-flex justify-content-between align-items-center" id="agente-{{ $agente->id }}">
                        <span style="color: gray;">{{ $agente->usuario }}</span>
                        <div class="form-check form-switch d-flex align-items-center">

                            <input class="form-check-input" type="checkbox"
                                name="agentes[{{ $agente->id }}]"
                                data-agente-id="{{ $agente->id }}"
                                {{ in_array($agente->id, $idsEditar) ? 'checked' : '' }}>
                            <label class="ms-2">{{ in_array($agente->id, $idsEditar) ? 'Editar' : 'Visualizar' }}</label>
                        </div>
                        <input type="hidden" name="agentesVisualizar[{{ $agente->id }}]" value="1">
                        <button type="button" class="btn btn-danger btn-sm ms-2 remove-agente">Remover</button>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</div>


