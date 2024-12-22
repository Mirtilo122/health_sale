<?php
include("protect.php");
include("../conexao.php");

if (!defined('BASE_PATH')) {
    define('BASE_PATH', __DIR__ . '/');
}

if (!defined('BASE_URL')) {
    define('BASE_URL', '/admin/');
}

$selected_status = isset($_GET['status']) ? $_GET['status'] : '';
$filter_query = '';

$nivel_acesso = $_SESSION['acesso'];
$id_usuario = $_SESSION['id'];

$query = "SELECT codigo_solicitacao, nome_solicitante, nome_paciente, tipo_orcamento, status, urgencia FROM solicitacoes_orcamentos ";

if ($selected_status) {
    $filter_query = "WHERE status = :status ";
}

if ($nivel_acesso === 'Agente' || $nivel_acesso === 'Externo') {
    $filter_query .= ($filter_query ? "AND " : "WHERE ") . "id_usuario = :id_usuario ";
}

$query .= $filter_query;
$stmt = $pdo->prepare($query);

if ($selected_status) {
    $stmt->bindParam(':status', $selected_status, PDO::PARAM_STR);
}
if ($nivel_acesso === 'Agente' || $nivel_acesso === 'Externo') {
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
}

$stmt->execute();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="espaco"></div>

    <div class="container">
        <h2>Solicitações de Orçamento</h2>

        <form method="get" action="">
            <label for="status">Filtrar por Status:</label>
            <select name="status" id="status">
                <option value="">Todos</option>
                <option value="pendente" <?= ($selected_status === 'pendente' ? 'selected' : '') ?>>Pendente</option>
                <option value="aguardando" <?= ($selected_status === 'aguardando' ? 'selected' : '') ?>>Aguardando</option>
                <option value="negociação" <?= ($selected_status === 'negociação' ? 'selected' : '') ?>>Negociação</option>
                <option value="cancelado" <?= ($selected_status === 'cancelado' ? 'selected' : '') ?>>Cancelado</option>
                <option value="aprovado" <?= ($selected_status === 'aprovado' ? 'selected' : '') ?>>Aprovado</option>
            </select>
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </form>

        <div class="list-group mt-4">
            <?php
            if ($stmt->rowCount() > 0) { 
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $statusClass = '';
                    switch (strtolower($row['status'])) {
                        case 'pendente':
                            $statusClass = 'bg-secondary text-dark';
                            break;
                        case 'aguardando':
                            $statusClass = 'bg-warning text-dark';
                            break;
                        case 'negociação':
                            $statusClass = 'bg-primary text-white';
                            break;
                        case 'cancelado':
                            $statusClass = 'bg-danger text-white';
                            break;
                        case 'aprovado':
                            $statusClass = 'bg-success text-white';
                            break;
                    }
            
                    echo "<div class='list-group-item d-flex justify-content-between align-items-center'>";
                    echo "<div>";
                    echo "<h5>Solicitante: " . htmlspecialchars($row['nome_solicitante']) . "</h5>";
                    echo "<p>Paciente: " . htmlspecialchars($row['nome_paciente']) . "</p>";
                    echo "<p>Tipo de Orçamento: " . htmlspecialchars($row['tipo_orcamento']) . "</p>";
                    echo "<div><strong>Status:</strong> <span class='badge $statusClass'>" . htmlspecialchars($row['status']) . "</span></div>";
                    
                    if ($row['urgencia'] == 1) {
                        echo "<div class='text-danger d-flex align-items-center mt-2'>";
                        echo "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-exclamation-triangle me-2' viewBox='0 0 16 16'>";
                        echo "<path d='M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z'/>";
                        echo "<path d='M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z'/>";
                        echo "</svg>";
                        echo "<span>Urgente</span>";
                        echo "</div>";
                    }
            
                    echo "</div>";
            
                    switch (strtolower($row['status'])) {
                        case 'pendente':
                            echo "<a href='atribuir_orcamento.php?codigo_solicitacao=" . $row['codigo_solicitacao'] . "' class='btn btn-secondary'>Detalhes</a>";
                            break;
                        case 'aguardando':
                            echo "<a href='criar_orcamentos.php?codigo_solicitacao=" . $row['codigo_solicitacao'] . "' class='btn btn-warning'>Criar Orçamento</a>";
                            break;
                        case 'negociação':
                            echo "<a href='visualizar_orcamento.php?codigo_solicitacao=" . $row['codigo_solicitacao'] . "' class='btn btn-info'>Visualizar</a>";
                            echo " <a href='editar_orcamento.php?codigo_solicitacao=" . $row['codigo_solicitacao'] . "' class='btn btn-primary'>Editar</a>";
                            break;
                        case 'cancelado':
                        case 'aprovado':
                            echo "<a href='visualizar_orcamento.php?codigo_solicitacao=" . $row['codigo_solicitacao'] . "' class='btn btn-success'>Visualizar</a>";
                            break;
                    }
            
                    echo "</div>";
                }
            } else {
                echo "<p>Nenhuma solicitação de orçamento encontrada.</p>";
            }
            
            ?>
        </div>
    </div>
</body>
</html>
