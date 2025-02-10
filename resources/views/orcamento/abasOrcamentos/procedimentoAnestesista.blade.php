<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#procedimentoModalAnestesista">
    Inserir Novo Procedimento
</button>


<div class="modal fade" id="procedimentoModalAnestesista" tabindex="-1" aria-labelledby="procedimentoModalLabelAnestesista" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="procedimentoModalLabelAnestesista">Novo Procedimento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="procedimentoNomeAnestesista" class="form-label">Nome do Procedimento</label>
                    <input type="text" class="form-control" id="procedimentoNomeAnestesista" placeholder="Digite o nome">
                </div>
                <div class="mb-3">
                    <label for="procedimentoValorAnestesista" class="form-label">Valor</label>
                    <input type="number" class="form-control" id="procedimentoValorAnestesista" placeholder="Digite o valor">
                </div>
                <div class="mb-3">
                    <label for="procedimentoTussAnestesista" class="form-label">Código Tuss</label>
                    <input type="number" class="form-control" id="procedimentoTussAnestesista" placeholder="Digite o código Tuss">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="salvarProcedimentoAnestesista">Prosseguir</button>
            </div>
        </div>
    </div>
</div>


<table class="table mt-3">
    <thead>
        <tr>
            <th>Nome do Procedimento</th>
            <th>Código TUSS</th>
            <th>Valor</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody id="tabela-procedimentosAnestesista">

    </tbody>
</table>
