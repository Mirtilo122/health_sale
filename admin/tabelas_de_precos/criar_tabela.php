<?php
include_once("../../conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_tabela = $_POST['nome_tabela'];
    $procedimentos = [
        $_POST['procedimento1'],
        $_POST['procedimento2'],
        $_POST['procedimento3'],
        $_POST['procedimento4'],
        $_POST['procedimento5'],
        $_POST['procedimento6'],
        $_POST['procedimento7'],
        $_POST['procedimento8'],
        $_POST['procedimento9'],
        $_POST['procedimento10'],
        $_POST['procedimento11'],
        $_POST['procedimento12'],
        $_POST['procedimento13'],
        $_POST['procedimento14'],
        $_POST['procedimento15']
    ];

    $sql_check = "SELECT * FROM tabela_de_precos WHERE nome_tabela = :nome_tabela";
    $stmt = $pdo->prepare($sql_check);
    $stmt->bindParam(':nome_tabela', $nome_tabela, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo "Já existe uma tabela com esse nome. Tente novamente.";
    } else {
        $sql_insert = "INSERT INTO tabela_de_precos (nome_tabela, procedimento1, procedimento2, procedimento3, procedimento4, procedimento5, procedimento6, procedimento7, procedimento8, procedimento9, procedimento10, procedimento11, procedimento12, procedimento13, procedimento14, procedimento15) 
                       VALUES (:nome_tabela, :procedimento1, :procedimento2, :procedimento3, :procedimento4, :procedimento5, :procedimento6, :procedimento7, :procedimento8, :procedimento9, :procedimento10, :procedimento11, :procedimento12, :procedimento13, :procedimento14, :procedimento15)";

        $stmt_insert = $pdo->prepare($sql_insert);
        $stmt_insert->bindParam(':nome_tabela', $nome_tabela);
        $stmt_insert->bindParam(':procedimento1', $procedimentos[0]);
        $stmt_insert->bindParam(':procedimento2', $procedimentos[1]);
        $stmt_insert->bindParam(':procedimento3', $procedimentos[2]);
        $stmt_insert->bindParam(':procedimento4', $procedimentos[3]);
        $stmt_insert->bindParam(':procedimento5', $procedimentos[4]);
        $stmt_insert->bindParam(':procedimento6', $procedimentos[5]);
        $stmt_insert->bindParam(':procedimento7', $procedimentos[6]);
        $stmt_insert->bindParam(':procedimento8', $procedimentos[7]);
        $stmt_insert->bindParam(':procedimento9', $procedimentos[8]);
        $stmt_insert->bindParam(':procedimento10', $procedimentos[9]);
        $stmt_insert->bindParam(':procedimento11', $procedimentos[10]);
        $stmt_insert->bindParam(':procedimento12', $procedimentos[11]);
        $stmt_insert->bindParam(':procedimento13', $procedimentos[12]);
        $stmt_insert->bindParam(':procedimento14', $procedimentos[13]);
        $stmt_insert->bindParam(':procedimento15', $procedimentos[14]);

        if ($stmt_insert->execute()) {
            echo "Tabela criada com sucesso!";
        } else {
            echo "Erro ao criar a tabela. Tente novamente.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Tabela</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/main.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>

    <?php include '../header.php'; ?>
    
    <div class="espaco"></div>
    <div class="espaco"></div>

    <div class="container">
        <h2>Criar Nova Tabela de Preços</h2>
        <form method="POST" action="criar_tabela.php">
            <div class="mb-3">
                <label for="nome_tabela" class="form-label">Nome da Tabela</label>
                <input type="text" class="form-control" id="nome_tabela" name="nome_tabela" required>
            </div>

            <?php
            for ($i = 1; $i <= 15; $i++) {
                echo "<div class='mb-3'>
                        <label for='procedimento$i' class='form-label'>Procedimento $i</label>
                        <input type='text' class='form-control' id='procedimento$i' name='procedimento$i' required>
                      </div>";
            }
            ?>

            <button type="submit" class="btn btn-primary">Criar Tabela</button>
        </form>
    </div>

</body>
</html>
