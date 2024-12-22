<?php

include_once("../../conexao.php");

include("../protect.php");

if ($_SESSION['acesso'] !== 'Administrador') {
    echo "<h1>Acesso Negado</h1>";
    echo "<p>Você não tem permissão para acessar esta página.</p>";
    exit;
}

if (isset($_GET['id'])) {
    $id_tabela = $_GET['id'];

    $sql = "SELECT * FROM tabela_de_precos WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id_tabela, PDO::PARAM_INT);
    $stmt->execute();
    $tabela = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($tabela) {
        $nome_tabela = $tabela['nome_tabela'];
        $procedimentos = [
            'Procedimento 1' => $tabela['procedimento1'],
            'Procedimento 2' => $tabela['procedimento2'],
            'Procedimento 3' => $tabela['procedimento3'],
            'Procedimento 4' => $tabela['procedimento4'],
            'Procedimento 5' => $tabela['procedimento5'],
            'Procedimento 6' => $tabela['procedimento6'],
            'Procedimento 7' => $tabela['procedimento7'],
            'Procedimento 8' => $tabela['procedimento8'],
            'Procedimento 9' => $tabela['procedimento9'],
            'Procedimento 10' => $tabela['procedimento10'],
            'Procedimento 11' => $tabela['procedimento11'],
            'Procedimento 12' => $tabela['procedimento12'],
            'Procedimento 13' => $tabela['procedimento13'],
            'Procedimento 14' => $tabela['procedimento14'],
            'Procedimento 15' => $tabela['procedimento15'],
        ];
    } else {
        echo "Tabela não encontrada.";
        exit;
    }
} else {
    echo "ID da tabela não informado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Visualizar Tabela</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="../css/main.css"></head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<body>

    <?php include '../header.php'; ?>

    <div class="espaco"></div>

    <div class="container">
        <h2>Visualizar Tabela: <?php echo htmlspecialchars($nome_tabela); ?></h2>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Procedimento</th>
                    <th scope="col">Custo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($procedimentos as $nome => $custo) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($nome); ?></td>
                        <td><?php echo htmlspecialchars($custo); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>
</html>
