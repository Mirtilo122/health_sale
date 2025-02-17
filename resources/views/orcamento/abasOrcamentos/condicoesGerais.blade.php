

<h4>Condições Gerais</h4>



<div class="select_alterar mb-4">
    <select id="presetSelect">
        <option value="{{ $orcamento->condicoes_gerais }}" selected>Salvo para esse orçamento
        </option>
        @foreach ($modelos as $modelo)
            <option value="{{ $modelo['conteudo'] }}" data-nome="{{ $modelo['nome'] }}">
                {{ $modelo['nome'] }}
            </option>
        @endforeach
    </select>
    <button type="button" id="insertPreset" class="alterar-btn">Adicionar</button>
</div>

<textarea id="editor" name="condicoes_gerais"></textarea>

