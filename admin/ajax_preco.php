<?php

include("../conexao.php");

if (isset($_GET['preco_id'])) {
    $preco_id = $_GET['preco_id'];

    $sql_precos = "SELECT enfermaria_diaria, apartamento_diaria, uti_adulto_diaria FROM tabela_de_precos WHERE id = :preco_id";
    $stmt_precos = $pdo->prepare($sql_precos);
    $stmt_precos->bindParam(':preco_id', $preco_id, PDO::PARAM_INT);
    $stmt_precos->execute();
    $precos = $stmt_precos->fetch(PDO::FETCH_ASSOC);

    
    echo json_encode($precos);
} else {
    echo json_encode(['error' => 'ID não fornecido']);
}
?>
