<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#procedimentoModal">
    Adicionar Novo
</button>

<input type="hidden" id="precosProcedimentosLoad"
       value='{{ old("precos_procedimentos", $orcamento->precos_procedimentos ?? "[]") }}'>

<input type="hidden" name="precos_procedimentos" id="precosProcedimentosInput">

<div class="modal fade" id="procedimentoModal" tabindex="-1" aria-labelledby="procedimentoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="procedimentoModalLabel">Novo Procedimento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="procedimentoNome" class="form-label">Nome do Procedimento</label>
                    <input type="text" class="form-control" id="procedimentoNome" placeholder="Digite o nome">
                </div>
                <div class="mb-3">
                    <label for="procedimentoValor" class="form-label">Valor Unitário</label>
                    <input type="text" class="form-control money" id="procedimentoValor" value="0,00">
                </div>
                <div class="mb-3">
                    <label for="procedimentoQntd" class="form-label">Quantidade</label>
                    <input type="number" class="form-control" id="procedimentoQntd" placeholder="Digite a quantidade">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="salvarProcedimento">Prosseguir</button>
            </div>
        </div>
    </div>
</div>


<table class="table borda_completa_tabela mt-3">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Quantidade</th>
            <th>Valor Unitário</th>
            <th class="d-none prazoHospital">Valor a Prazo</th>
            <th>Valor Total</th>
            <th class="d-none prazoHospital">Valor Total a Prazo</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody id="tabela-procedimentos">

    </tbody>
</table>


<button type="button" class="btn btn-primary prazoHospital mt-2" onclick="addVisibilidadePrazoHospital()">Adicionar Valores a Prazo</button>
<button type="button" class="btn btn-primary prazoHospital d-none mt-2" onclick="removeVisibilidadePrazoHospital()">Remover Valores a Prazo</button>
