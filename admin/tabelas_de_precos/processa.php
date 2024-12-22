<?php

include("../protect.php");

if (isset($_GET['dado'])) {
    $valor = htmlspecialchars($_GET['dado'], ENT_QUOTES, 'UTF-8');
    echo "Dado recebido pela URL: " . $valor;
}

if ($_SESSION['acesso'] !== 'Administrador') {
    echo "<h1>Acesso Negado</h1>";
    echo "<p>Você não tem permissão para acessar esta página.</p>";
    exit;
}

include_once("../../conexao.php");

if (!empty($_FILES["arquivo"]["tmp_name"])) {
    $arquivo = new DomDocument(); 

    if ($arquivo->load($_FILES['arquivo']['tmp_name'])) {
        $linhas = $arquivo->getElementsByTagName('Row');
        $primeira_linha = true;

        foreach ($linhas as $linha) {
            if ($primeira_linha == false) {
                $procedimentos = [];
                
                $nome_tabela = $linha->getElementsByTagName('Data')->item(0)->nodeValue ?? null;
                if ($nome_tabela) {
                    $nome_tabela = htmlspecialchars($nome_tabela, ENT_QUOTES, 'UTF-8');
                }

                for ($i = 1; $i < 16; $i++) {
                    $data = $linha->getElementsByTagName('Data')->item($i);
                    $procedimentos[$i] = $data ? $data->nodeValue : null;
                }

                $codspell = $procedimentos[1];

                $sql_check = "SELECT * FROM tabela_de_precos WHERE id = :id";
                $stmt = $pdo->prepare($sql_check);
                $stmt->bindParam(':id', $codspell, PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$result) {
                    $sql_insert = "INSERT INTO tabela_de_precos 
                        (nome_tabela, procedimento1, procedimento2, procedimento3, procedimento4, procedimento5, procedimento6, 
                        procedimento7, procedimento8, procedimento9, procedimento10, procedimento11, procedimento12, procedimento13, 
                        procedimento14, procedimento15) 
                        VALUES 
                        (:nome_tabela, :procedimento1, :procedimento2, :procedimento3, :procedimento4, :procedimento5, :procedimento6, 
                        :procedimento7, :procedimento8, :procedimento9, :procedimento10, :procedimento11, :procedimento12, 
                        :procedimento13, :procedimento14, :procedimento15)";

                    $stmt_insert = $pdo->prepare($sql_insert);
                    $stmt_insert->bindParam(':nome_tabela', $nome_tabela);
                    $stmt_insert->bindParam(':procedimento1', $procedimentos[1]);
                    $stmt_insert->bindParam(':procedimento2', $procedimentos[2]);
                    $stmt_insert->bindParam(':procedimento3', $procedimentos[3]);
                    $stmt_insert->bindParam(':procedimento4', $procedimentos[4]);
                    $stmt_insert->bindParam(':procedimento5', $procedimentos[5]);
                    $stmt_insert->bindParam(':procedimento6', $procedimentos[6]);
                    $stmt_insert->bindParam(':procedimento7', $procedimentos[7]);
                    $stmt_insert->bindParam(':procedimento8', $procedimentos[8]);
                    $stmt_insert->bindParam(':procedimento9', $procedimentos[9]);
                    $stmt_insert->bindParam(':procedimento10', $procedimentos[10]);
                    $stmt_insert->bindParam(':procedimento11', $procedimentos[11]);
                    $stmt_insert->bindParam(':procedimento12', $procedimentos[12]);
                    $stmt_insert->bindParam(':procedimento13', $procedimentos[13]);
                    $stmt_insert->bindParam(':procedimento14', $procedimentos[14]);
                    $stmt_insert->bindParam(':procedimento15', $procedimentos[15]);

                    $stmt_insert->execute();

                    echo 'A tabela foi incluída com sucesso <br><br>';
                } else {
                    echo 'A tabela já existe no banco de dados <br><br>';
                }
            }
            $primeira_linha = false;
        }
    } else {
        echo "Erro ao carregar o arquivo XML.";
    }
} else {
    echo "Nenhum arquivo foi enviado.";
}
?>
