<h4>Informações do Paciente</h4><br>
<div class="row mt-1 d-flex">
    <div class="col-md-4 border-end border-grey">
        <label for="nomePaciente">Nome do Paciente:</label>
        <input type="text" name="nomePaciente" id="nomePaciente" value="{{$solicitacao->nome_paciente}}"><br><br>

        <label for="dataNascPaciente">Data de Nascimento:</label>
        <input type="date" id="dataNascPaciente" name="dataNascPaciente" value="{{$solicitacao->data_nascimento}}" required><br><br>

        <label for="cidadePaciente">Cidade:</label>
        <input type="text" id="cidadePaciente" name="cidadePaciente" value="{{$solicitacao->cidade}}" required><br><br>
    </div>

    <div class="col-md-4 border-end border-grey">
        <label for="comorbidadesPaciente">Paciente tem Comorbidades?</label>
        <div class="select_alterar">
            <select id="comorbidadesPaciente" name="comorbidadesPaciente" onchange="toggleComorbidades()" disabled>
                <option value="nao" @selected($solicitacao->comorbidades === "nao")>Não</option>
                <option value="sim" @selected($solicitacao->comorbidades === "sim")>Sim</option>
            </select>
            <button type="button" class="alterar-btn" onclick="alterar('comorbidadesPaciente')">Alterar</button>
        </div><br><br>


        <div id="comorbidade" class="{{ $solicitacao->comorbidades === 'sim' ? '' : 'd-none' }}">
            <label for="descComorbidades">Descrição das Comorbidades:</label>
            <textarea id="descComorbidades" name="descComorbidades" rows="4">{{$solicitacao->descricao_comorbidades}}</textarea>
        </div>
    </div>

    <div class="col-md-4">
        <label for="observacoesPaciente">Observações:</label>
        <textarea id="observacoesPaciente" name="observacoesPaciente" rows="4"></textarea>
    </div>
</div>
