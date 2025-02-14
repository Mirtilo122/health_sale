<script src="https://cdn.tiny.cloud/1/z60j7ybmsne92rqccjp9unybou8qqjil0ot4mdkamd36zfyz/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<h4>Condições Gerais</h4>


<div class="select_alterar mb-4">
    <select id="presetSelect">
        <option value="{{ htmlentities($orcamento->condicoes_gerais) }}" selected>Salvo para esse orçamento
        </option>
        @foreach ($modelos as $modelo)
            <option value="{{ htmlentities($modelo['conteudo']) }}" data-nome="{{ $modelo['nome'] }}">
                {{ $modelo['nome'] }}
            </option>
        @endforeach
    </select>
    <button type="button" id="insertPreset" class="alterar-btn">Adicionar</button>
</div>

<textarea id="editor" name="condicoes_gerais"></textarea>

