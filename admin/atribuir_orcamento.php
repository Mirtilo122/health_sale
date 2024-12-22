<?php 
include("../conexao.php");

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Orçamento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        header {
            background-color: #007bff;
            color: white;
            padding: 1rem;
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 1rem;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        .info {
            margin-bottom: 1rem;
        }
        .info strong {
            display: inline-block;
            width: 150px;
        }
        select, input[type="submit"] {
            padding: 0.5rem;
            width: 100%;
            margin-top: 0.5rem;
        }
        .buttons {
            margin-top: 1rem;
            display: flex;
            justify-content: space-between;
        }
        .buttons a, .buttons input {
            padding: 0.5rem 1rem;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            text-align: center;
        }
        .buttons a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <header>
        <h1>Editar Orçamento</h1>
    </header>
    <div class="container">
        <?php
        if (isset($_GET['codigo_solicitacao']) && is_numeric($_GET['codigo_solicitacao'])) {
            $id = intval($_GET['codigo_solicitacao']);

            $query = "SELECT * FROM solicitacoes_orcamentos WHERE codigo_solicitacao = :codigo_solicitacao";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':codigo_solicitacao', $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $detalhes = $stmt->fetch(PDO::FETCH_ASSOC);

                echo "<h1>Orçamento #" . htmlspecialchars($detalhes['codigo_solicitacao']) . "</h1>";
                echo "<form action='atualizar_orcamento.php' method='POST'>";
                echo "<div class='info'><strong>Nome do Solicitante:</strong> " . htmlspecialchars($detalhes['nome_solicitante']) . "</div>";
                echo "<div class='info'><strong>Telefone:</strong> " . htmlspecialchars($detalhes['telefone']) . "</div>";
                echo "<div class='info'><strong>Email:</strong> " . htmlspecialchars($detalhes['email']) . "</div>";
                echo "<div class='info'><strong>Nome do Paciente:</strong> " . htmlspecialchars($detalhes['nome_paciente']) . "</div>";
                echo "<div class='info'><strong>Data de Nascimento:</strong> " . htmlspecialchars($detalhes['data_nascimento']) . "</div>";
                echo "<div class='info'><strong>Tipo de Orçamento:</strong> " . htmlspecialchars($detalhes['tipo_orcamento']) . "</div>";
                echo "<div class='info'><strong>Convênio:</strong> " . htmlspecialchars($detalhes['convenio']) . "</div>";
                echo "<div class='info'><strong>Cidade:</strong> " . htmlspecialchars($detalhes['cidade']) . "</div>";

                echo "<div class='info'><strong>Status Atual:</strong> " . htmlspecialchars($detalhes['status']) . "</div>";

                echo "<div class='info'><strong>Vincular a Usuário:</strong><br>";
                echo "<select name='id_usuario'>";
                echo "<option value=''>Selecione um usuário</option>";

                $queryUsuarios = "SELECT id, usuario FROM usuarios WHERE acesso IN ('Agente', 'Externo')";
                $stmtUsuarios = $pdo->query($queryUsuarios);

                while ($usuario = $stmtUsuarios->fetch(PDO::FETCH_ASSOC)) {
                    $selected = ($detalhes['id_usuario'] == $usuario['id']) ? 'selected' : '';
                    echo "<option value='" . $usuario['id'] . "' $selected>" . htmlspecialchars($usuario['usuario']) . "</option>";
                }

                echo "</select></div>";

                echo "<div class='buttons'>";
                echo "<a href='painel.php'>Cancelar</a>";
                echo "<input type='submit' value='Salvar'>";
                echo "<input type='hidden' name='codigo_solicitacao' value='" . $detalhes['codigo_solicitacao'] . "'>";
                echo "</div>";

                echo "</form>";
            } else {
                echo "<p>Orçamento não encontrado.</p>";
            }
        } else {
            echo "<p>ID inválido.</p>";
        }
        ?>
    </div>
</body>
</html>
