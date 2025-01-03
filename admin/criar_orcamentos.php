<?php

include("protect.php");
include("../conexao.php");


$id_solicitacao = $_GET['codigo_solicitacao'] ?? null;

if (!$id_solicitacao) {
    echo "ID da solicitação não fornecido.";
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM solicitacoes_orcamentos WHERE codigo_solicitacao = ?");
$stmt->execute([$id_solicitacao]);
$solicitacao = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$solicitacao) {
    echo "Solicitação não encontrada.";
    exit;
}

if ($solicitacao && !empty($solicitacao['arquivo_pdf'])) {
    $arquivoPdf = $solicitacao['arquivo_pdf'];
    $arquivoUrl = '../uploads/' . basename($arquivoPdf); 
}

$stmti = $pdo->query("SELECT * FROM tabela_de_precos ORDER BY id DESC");
$tabelas_precos = $stmti->fetchAll(PDO::FETCH_ASSOC);

$preco_id = $tabelas_precos[0]['id'];

$sql_precos = "SELECT enfermaria_diaria, apartamento_diaria, uti_adulto_diaria, anestesia_raqui, anestesia_sma, anestesia_peridural, anestesia_sedacao, 
                 anestesia_externo, anestesia_bloqueio, anestesia_local FROM tabela_de_precos WHERE id = :preco_id";
$stmt_precos = $pdo->prepare($sql_precos);
$stmt_precos->bindParam(':preco_id', $preco_id, PDO::PARAM_INT);
$stmt_precos->execute();
$precos = $stmt_precos->fetch(PDO::FETCH_ASSOC);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $formulario = $_POST['formulario'] ?? '';
    $nomeSolicitante = $_POST['nome'] ?? '';
    $sobrenome = $_POST['sobrenome'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $email = $_POST['email'] ?? '';
    $canalContato = $_POST['contato'] ?? '';
    $tipoOrcamento = $_POST['tipoOrcamento'] ?? '';
    $convenio = $_POST['convenio'] ?? '';
    $nomePaciente = $_POST['nomePaciente'] ?? '';
    $dataNascimento = $_POST['dataNasc'] ?? null;
    $cidade = $_POST['cidade'] ?? '';
    $comorbidades = $_POST['comorbidades'] ?? 'nao';
    $descricaoComorbidades = $_POST['descComorbidades'] ?? null;
    $descricaoSumaria = $_POST['descSumaria'] ?? '';
    $descricaoDetalhada = $_POST['descDetalhada'] ?? '';
    $tempoCirurgia = $_POST['tempoCirurgico'] ?? 0;
    $dataProvavel = $_POST['dataProvavel'] ?? null;
    $diariasEnfermaria = $_POST['enfermaria'] ?? 0;
    $diariasApartamento = $_POST['apartamento'] ?? 0;
    $diariasUTI = $_POST['utiAdulto'] ?? 0;
    $anestesias = isset($_POST['anestesia']) ? implode(",", $_POST['anestesia']) : null;
    $anestesiaOutros = $_POST['anestesiaOutros'] ?? null;
    $observacoes = $_POST['observacoes'] ?? '';
    $urgenteImediato = $_POST['urgenteImediato'] ?? 0;


    $query = "INSERT INTO orcamentos (
        solicitante, nome_solicitante, telefone, email, canal_contato, tipo_orcamento, convenio,
        nome_paciente, data_nascimento, cidade, comorbidades, descricao_comorbidades,
        resumo_procedimento, detalhes_procedimento, tempo_cirurgia, data_provavel,
        diarias_enfermaria, diarias_apartamento, diarias_uti, anestesia_raqui, anestesia_sma,
        anestesia_peridural, anestesia_sedacao, anestesia_externo, anestesia_bloqueio,
        anestesia_local, anestesia_outros, observacoes, arquivo_pdf, urgencia
    ) VALUES (
        :solicitante, :nome_solicitante, :telefone, :email, :canal_contato, :tipo_orcamento, :convenio,
        :nome_paciente, :data_nascimento, :cidade, :comorbidades, :descricao_comorbidades,
        :resumo_procedimento, :detalhes_procedimento, :tempo_cirurgia, :data_provavel,
        :diarias_enfermaria, :diarias_apartamento, :diarias_uti, :anestesia_raqui, :anestesia_sma,
        :anestesia_peridural, :anestesia_sedacao, :anestesia_externo, :anestesia_bloqueio,
        :anestesia_local, :anestesia_outros, :observacoes, :arquivo_pdf, :urgencia
    )";


    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ':solicitante' => $formulario,
        ':nome_solicitante' => "$nomeSolicitante $sobrenome",
        ':telefone' => $telefone,
        ':email' => $email,
        ':canal_contato' => $canalContato,
        ':tipo_orcamento' => $tipoOrcamento,
        ':convenio' => $convenio,
        ':nome_paciente' => $nomePaciente,
        ':data_nascimento' => $dataNascimento,
        ':cidade' => $cidade,
        ':comorbidades' => $comorbidades,
        ':descricao_comorbidades' => $descricaoComorbidades,
        ':resumo_procedimento' => $descricaoSumaria,
        ':detalhes_procedimento' => $descricaoDetalhada,
        ':tempo_cirurgia' => $tempoCirurgia,
        ':data_provavel' => $dataProvavel,
        ':diarias_enfermaria' => $diariasEnfermaria,
        ':diarias_apartamento' => $diariasApartamento,
        ':diarias_uti' => $diariasUTI,
        ':anestesia_raqui' => strpos($anestesias, 'raqui') !== false ? 1 : 0,
        ':anestesia_sma' => strpos($anestesias, 'sma') !== false ? 1 : 0,
        ':anestesia_peridural' => strpos($anestesias, 'peridural') !== false ? 1 : 0,
        ':anestesia_sedacao' => strpos($anestesias, 'sedacao') !== false ? 1 : 0,
        ':anestesia_externo' => strpos($anestesias, 'externo') !== false ? 1 : 0,
        ':anestesia_bloqueio' => strpos($anestesias, 'bloqueio') !== false ? 1 : 0,
        ':anestesia_local' => strpos($anestesias, 'local') !== false ? 1 : 0,
        ':anestesia_outros' => $anestesiaOutros,
        ':observacoes' => $observacoes,
        ':arquivo_pdf' => $arquivoPDF,
        ':urgencia' => $urgenteImediato
    ]);

    $stmt = $pdo->prepare("INSERT INTO orcamentos 
        (id_solicitacao, nome_solicitante, telefone, email, tipo_orcamento, valor_total, usuarios_vinculados, data_criacao) 
        VALUES (:id_solicitacao, :nome_solicitante, :telefone, :email, :tipo_orcamento, :valor_total, :usuarios_vinculados, :data_criacao)
    ");

    if ($stmt->execute($dados_orcamento)) {
        echo "Orçamento criado com sucesso!";
        exit;
    } else {
        echo "Erro ao criar orçamento.";
    }

    echo "Formulário enviado com sucesso!";

}

$convenioAtual = $solicitacao['convenio'] ;
$solicitacao_id = $solicitacao['codigo_solicitacao'];
$contatoAtual = $solicitacao['canal_contato'];


  
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Orçamento</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


    <style>
        div{
            display: flex;
            flex-direction: column;
        }

        main{
            padding: 5%;
        }

        .hidden {
            display: none;
        }

    </style>
</head>
<body>
    <main>
        <h1>Criar Orçamento</h1>

        <form method="POST">
            <fieldset>
                <legend>Informações da Solicitação</legend>

                <div>
                    <h1>Informações do Solicitante</h1> <br>

                    <label for="formulario">Solicitante</label>
                    <input type="text" id="formulario" name="formulario">

                    <label for="nome">Nome do Solicitante</label>
                    <input type="text" id="nome" name="nome">

                    <label for="sobrenome">Sobrenome</label>
                    <input type="text" id="sobrenome" name="sobrenome">
                    
                    <label for="telefone">Telefone</label>
                    <input type="tel" id="telefone" name="telefone">
                    
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email">
                    
                    <label for="contato">Canal de Preferência para Contato</label>
                    <div style="display: flex; flex-direction: row; align-items: center; gap: 10px;">
                        <select id="contato" name="contato" disabled>
                            <option value="email" <?php echo $contatoAtual === "email" ? "selected" : ""; ?>>E-mail</option>
                            <option value="telefone" <?php echo $contatoAtual === "telefone" ? "selected" : ""; ?>>Telefone</option>
                        </select>
                        <button type="button" id="alterarContato" onclick="alterar('contato')">Alterar</button>
                    </div>

                </div>

                <div>
                    <h1>Informações do Paciente</h1> <br>

                    <label for="nomePaciente">Nome do Paciente</label>
                    <input type="text" id="nomePaciente" name="nomePaciente">

                    <label for="dataNasc">Data de Nascimento</label>
                    <input type="date" id="dataNasc" name="dataNasc">

                    <label for="cidade">Cidade</label>
                    <input type="text" id="cidade" name="cidade">

                    <label for="comorbidades">Paciente tem Comorbidades?</label>
                    <input type="text" id="cidade" name="cidade" disabled>
                    
                    <label for="descComorbidades">Descrição das Comorbidades</claslabel>
                    <textarea id="descComorbidades" name="descComorbidades" disabled></textarea>

                </div>

                <div>
                    <h1>Informações do Cirurgião</h1> <br>

                    <label for="cirurgiaoDefinido">Tem cirurgião definido?</label>
                </select>
                    <select id="cirurgiaoDefinido" name="cirurgiaoDefinido" onchange="toggleCirurgiao()">
                    <option value="">Selecione...</option>
                    <option value="nao">Não</option>
                    <option value="sim">Sim</option>
                </select>        

                <div class="hidden" id="dadosCirurgiao">
                    
                    <h3>Dados do Cirurgião</h3>
                    <label for="nome">Nome Completo</label>
                    <input type="text" id="nome" name="nome">
                    
                    <label for="telefoneCirurgiao">Telefone</label>
                    <input type="tel" id="telefone" name="telefone">
                    
                    <label for="emailCirurgiao">Email</label>
                    <input type="email" id="email" name="email">
                    
                    <label for="crmCirurgiao">CRM</label>
                    <input type="crmCirurgiao" id="crmCirurgiao" name="crmCirurgiao">   
                </div>

                <div>
                    <h3>Informações do Procedimento</h3>

                    <label for="tipoOrcamento">Tipo de Orçamento</label>
                    <select id="tipoOrcamento" name="tipoOrcamento">
                        <option value="cirurgia">Cirurgia</option>
                        <option value="parto">Parto e Maternidade</option>
                    </select>
                    

                    <label for="convenio">Convênio</label>
                    <div style="display: flex; flex-direction: row; align-items: center; gap: 10px;">
                        <select id="convenio" name="convenio" disabled>
                            <option value="nenhum" <?php echo $convenioAtual === "nenhum" ? "selected" : ""; ?>>Sem Convênio</option>
                            <option value="particular" <?php echo $convenioAtual === "particular" ? "selected" : ""; ?>>Particular</option>
                            <option value="cartaoDesconto" <?php echo $convenioAtual === "cartaoDesconto" ? "selected" : ""; ?>>Cartão Desconto</option>
                            <option value="judicial" <?php echo $convenioAtual === "judicial" ? "selected" : ""; ?>>Judicial</option>
                        </select>
                        <button type="button" id="alterarConvenio" onclick="alterar('convenio')">Alterar</button>
                    </div>

                    <label for="descSumaria">Descrição Sumária do Procedimento</label>
                    <textarea id="descSumaria" name="descSumaria"></textarea>

                    <label for="descDetalhada">Descrição Detalhada do Procedimento</label>
                    <textarea id="descDetalhada" name="descDetalhada"></textarea>

                    <label for="tempoCirurgico">Tempo Cirúrgico Previsto (em horas)</label>
                    <input type="number" id="tempoCirurgico" name="tempoCirurgico" min="0" step="0.5">

                    <label for="dataProvavel">Data Provável</label>
                    <input type="date" id="dataProvavel" name="dataProvavel">

                    <label for="urgenteImediato">Urgente/Imediato?</label>
                    <select id="urgenteImediato" name="urgenteImediato">
                        <option value="">Selecione...</option>
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>

                    <div>
                        <label for="observacoes">Observações Adicionais</label>
                        <textarea id="observacoes" name="observacoes"></textarea>
                    </div>
                </div>

                <div>
                    <h1>Solicitação em PDF</h1>

                    <?php if (isset($arquivoUrl)): ?>
                        <a href="<?= $arquivoUrl ?>" target="_blank" class="btn btn-info">Visualizar Solicitação</a>
                    <?php else: ?>
                        <p>Arquivo não disponível.</p>
                    <?php endif; ?>
                </div>
            </fieldset>









            <fieldset>

                <legend>Definir Preços</legend>

                <label for="tabela_preco">Tabela de Preços:</label>
                <select id="tabela_preco" name="tabela_preco" onchange="confirmarMudancaTabela(this)">
                    <?php foreach ($tabelas_precos as $tabela): ?>
                        <option value="<?= $tabela['id'] ?>" <?= $preco_id == $tabela['id'] ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($tabela['nome_tabela']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <div>
                    <label for="diarias_enfermaria">Enfermaria</label>
                    <input type="number" id="diarias_enfermaria" name="diarias_enfermaria" 
                        value="<?= isset($solicitacao['diarias_enfermaria']) ? $solicitacao['diarias_enfermaria'] : 0; ?>" 
                        min="0" onchange="atualizarTotal('enfermaria')">

                    <input type="number" id="valor_enfermaria" name="valor_enfermaria" 
                        value="<?= isset($precos['enfermaria_diaria']) ? $precos['enfermaria_diaria'] : 0; ?>" 
                        min="0" step="0.01" onchange="atualizarTotal('enfermaria')">

                    <input type="text" id="total_enfermaria" value="0.00" disabled>
                </div>

                <div>
                    <label for="diarias_apartamento">Apartamento</label>
                    <input type="number" id="diarias_apartamento" name="diarias_apartamento" 
                        value="<?= isset($solicitacao['diarias_apartamento']) ? $solicitacao['diarias_apartamento'] : 0; ?>" 
                        min="0" onchange="atualizarTotal('apartamento')">

                    <input type="number" id="valor_apartamento" name="valor_apartamento" 
                        value="<?= isset($precos['apartamento_diaria']) ? $precos['apartamento_diaria'] : 0; ?>" 
                        min="0" step="0.01" onchange="atualizarTotal('apartamento')">

                    <input type="text" id="total_apartamento" value="0.00" disabled>
                </div>

                <div>
                    <label for="diarias_uti">UTI Adulto</label>
                    <input type="number" id="diarias_uti" name="diarias_uti" 
                        value="<?= isset($solicitacao['diarias_uti']) ? $solicitacao['diarias_uti'] : 0; ?>" 
                        min="0" onchange="atualizarTotal('uti')">

                    <input type="number" id="valor_uti" name="valor_uti" 
                        value="<?= isset($precos['uti_adulto_diaria']) ? $precos['uti_adulto_diaria'] : 0; ?>" 
                        min="0" step="0.01" onchange="atualizarTotal('uti')">

                    <input type="text" id="total_uti" value="0.00" disabled>
                </div>

                <div>
                    <h3>Anestesia</h3>

                    <!-- Raqui -->

                    <label for="anestesia_raqui">
                        <input type="checkbox" id="anestesia_raqui" name="anestesia[]" value="raqui" class="anestesia" 
                            <?php echo isset($solicitacao['anestesia_raqui']) && $solicitacao['anestesia_raqui'] > 0 ? 'checked' : ''; ?> 
                            disabled>
                        Raqui (R$ <?php echo number_format($precos['anestesia_raqui'], 2, ',', '.'); ?>)
                    </label><br>

                    <!-- SMA -->

                    <label for="anestesia_sma">
                        <input type="checkbox" id="anestesia_sma" name="anestesia[]" value="raqui" class="anestesia" 
                            <?php echo isset($solicitacao['anestesia_sma']) && $solicitacao['anestesia_sma'] > 0 ? 'checked' : ''; ?> 
                            disabled>
                        SMA (R$ <?php echo number_format($precos['anestesia_sma'], 2, ',', '.'); ?>)
                    </label><br>

                    <!-- Peridural -->

                    <label for="anestesia_peridural">
                        <input type="checkbox" id="anestesia_peridural" name="anestesia[]" value="raqui" class="anestesia" 
                            <?php echo isset($solicitacao['anestesia_peridural']) && $solicitacao['anestesia_peridural'] > 0 ? 'checked' : ''; ?> 
                            disabled>
                        Peridural (R$ <?php echo number_format($precos['anestesia_peridural'], 2, ',', '.'); ?>)
                    </label><br>

                    <!-- Sedação -->

                    <label for="anestesia_sedacao">
                        <input type="checkbox" id="anestesia_sedacao" name="anestesia[]" value="raqui" class="anestesia" 
                            <?php echo isset($solicitacao['anestesia_sedacao']) && $solicitacao['anestesia_sedacao'] > 0 ? 'checked' : ''; ?> 
                            disabled>
                        Sedação (R$ <?php echo number_format($precos['anestesia_sedacao'], 2, ',', '.'); ?>)
                    </label><br>

                    <!-- Externo -->

                    <label for="anestesia_externo">
                        <input type="checkbox" id="anestesia_externo" name="anestesia[]" value="raqui" class="anestesia" 
                            <?php echo isset($solicitacao['anestesia_externo']) && $solicitacao['anestesia_externo'] > 0 ? 'checked' : ''; ?> 
                            disabled>
                        Externo (R$ <?php echo number_format($precos['anestesia_externo'], 2, ',', '.'); ?>)
                    </label><br>

                    <!-- Bloqueio -->

                    <label for="anestesia_bloqueio">
                        <input type="checkbox" id="anestesia_bloqueio" name="anestesia[]" value="raqui" class="anestesia" 
                            <?php echo isset($solicitacao['anestesia_bloqueio']) && $solicitacao['anestesia_bloqueio'] > 0 ? 'checked' : ''; ?> 
                            disabled>
                        Bloqueio (R$ <?php echo number_format($precos['anestesia_bloqueio'], 2, ',', '.'); ?>)
                    </label><br>

                    <!-- Local -->
                    
                    <label for="anestesia_local">
                        <input type="checkbox" id="anestesia_local" name="anestesia[]" value="raqui" class="anestesia" 
                            <?php echo isset($solicitacao['anestesia_local']) && $solicitacao['anestesia_local'] > 0 ? 'checked' : ''; ?> 
                            disabled>
                        Local (R$ <?php echo number_format($precos['anestesia_local'], 2, ',', '.'); ?>)
                    </label><br>

                    <button type="button" onclick="alterar('anestesia')">Alterar Anestesias</button>
                </div>

                <div class="modal" tabindex="-1" id="modalConfirmarMudanca">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Confirmação de Mudança</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Você tem certeza que deseja mudar a tabela de preços?</p>
                                <p>Todos os valores serão atualizados de acordo com a nova tabela selecionada.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="cancelarBtn">Cancelar</button>
                                <button type="button" class="btn btn-primary" id="continuarBtn">Continuar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <label>Valor Total:
                    <input type="number" name="valor_total" step="0.01" disabled>
                </label>
            </fieldset>

            <fieldset>
                <legend>Vincular Usuários</legend>
                <label>IDs de Usuários (separados por vírgulas):
                    <input type="text" name="usuarios_vinculados" placeholder="Ex.: 1,2,3">
                </label>
            </fieldset>

            <button type="submit">Criar Orçamento</button>
        </form>

    </main>
    <script>

            function confirmarMudancaTabela(select) {
                const modal = new bootstrap.Modal(document.getElementById('modalConfirmarMudanca'));
                const continuarBtn = document.getElementById('continuarBtn');
                const cancelarBtn = document.getElementById('cancelarBtn');
                
                modal.show();

                const tabelaAnterior = select.value;
                const tabelaId = select.value;

                continuarBtn.onclick = function() {
                    modal.hide();
                    atualizarTabela(tabelaId);
                };

                cancelarBtn.onclick = function() {
                    modal.hide();
                    select.value = tabelaAnterior;
                };
            }


            function atualizarTabela(tabelaId) {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'ajax_preco.php?preco_id=' + tabelaId, true);
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        var dados = JSON.parse(xhr.responseText);

                        if (dados.error) {
                            console.error(dados.error);
                        } else {
                            // Atualizar outros campos
                            document.getElementById('valor_enfermaria').value = dados.enfermaria_diaria;
                            document.getElementById('valor_apartamento').value = dados.apartamento_diaria;
                            document.getElementById('valor_uti').value = dados.uti_adulto_diaria;

                            atualizarTotal('enfermaria');
                            atualizarTotal('apartamento');
                            atualizarTotal('uti');

                            // Atualizar os valores das anestesias
                            const anestesias = [
                                { id: 'anestesia_raqui', preco: dados.anestesia_raqui },
                                { id: 'anestesia_sma', preco: dados.anestesia_sma },
                                { id: 'anestesia_peridural', preco: dados.anestesia_peridural },
                                { id: 'anestesia_sedacao', preco: dados.anestesia_sedacao },
                                { id: 'anestesia_externo', preco: dados.anestesia_externo },
                                { id: 'anestesia_bloqueio', preco: dados.anestesia_bloqueio },
                                { id: 'anestesia_local', preco: dados.anestesia_local }
                            ];

                            anestesias.forEach(anestesia => {
                                const label = document.querySelector(`label[for='${anestesia.id}']`);
                                if (label) {
                                    label.innerHTML = label.innerHTML.replace(
                                        /\(R\$ .*?\)/, 
                                        `(R$ ${parseFloat(anestesia.preco).toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })})`
                                    );
                                }
                            });
                        }
                    }
                };
                xhr.send();
            }

            function atualizarTotal(tipo) {
                let diarias = parseFloat(document.getElementById('diarias_' + tipo).value) || 0;
                let valorDiaria = parseFloat(document.getElementById('valor_' + tipo).value) || 0;
                
                let total = diarias * valorDiaria;
                
                document.getElementById('total_' + tipo).value = total.toFixed(2);
            }

            atualizarTotal('enfermaria');
            atualizarTotal('apartamento');
            atualizarTotal('uti');


        function toggleCirurgiao() {
            const cirurgiaoDefinido = document.getElementById("cirurgiaoDefinido").value;
            const dadosCirurgiao = document.getElementById("dadosCirurgiao");
        
            if (cirurgiaoDefinido === "sim") {
            dadosCirurgiao.classList.remove("hidden");
            } else {
            dadosCirurgiao.classList.add("hidden");
            }
        }

        function alterar(lista) {
            if (lista == 'anestesia') {
                const anestesias = document.querySelectorAll('.anestesia');

                anestesias.forEach(function(anestesia) {
                    anestesia.disabled = !anestesia.disabled;
                    if (!anestesia.disabled) {
                        anestesia.focus();
                    }
                });
            } else {
                const selectField = document.getElementById(lista);
                selectField.disabled = !selectField.disabled;
                if (!selectField.disabled) {
                    selectField.focus();
                }
            }
        }

    </script>
</body>
</html>
