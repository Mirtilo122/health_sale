<?php

include("../protect.php");

if ($_SESSION['acesso'] !== 'Administrador') {
    echo "<h1>Acesso Negado</h1>";
    echo "<p>Você não tem permissão para acessar esta página.</p>";
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tabelas de Preços</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="../css/main.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    
    <?php include '../header.php'; ?>


    <div class="espaco"></div>
    <div class="espaco"></div>

    <div class="incluir">
        <div class="btn"><a href="criar_tabela.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
            </svg>
            <p>Adicionar</p>
        </a></div>
        
        <div class="upload">
            <h2>UPLOAD XML</h2>
            <form method="POST" action="processa.php" enctype="multipart/form-data">
                <label>Arquivo</label>
                <input type="file" name="arquivo"><br><br>
                <input type="submit" value="Enviar">
            </form>
        </div>
    </div>

    <div class="container">
        <h2>Tabelas de Preços</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nome da Tabela</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include_once("../../conexao.php");
                    $sql = "SELECT * FROM tabela_de_precos";
                    $stmt = $pdo->query($sql);
                    $tabelas = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($tabelas as $tabela) {
                        echo "<tr>
                                <td>" . htmlspecialchars($tabela['nome_tabela']) . "</td>
                                <td><a href='visualizar_tabela.php?id=" . $tabela['id'] . "' class='btn btn-primary'>Visualizar</a></td>
                              </tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>
