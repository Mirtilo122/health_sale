<?php 
include("../conexao.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['codigo_solicitacao']) && is_numeric($_POST['codigo_solicitacao'])) {
        $codigo_solicitacao = intval($_POST['codigo_solicitacao']);
        $id_usuario = isset($_POST['id_usuario']) ? intval($_POST['id_usuario']) : null;

        try {
            $query = "UPDATE solicitacoes_orcamentos SET id_usuario = :id_usuario, status = 'Aguardando' WHERE codigo_solicitacao = :codigo_solicitacao";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':codigo_solicitacao', $codigo_solicitacao, PDO::PARAM_INT);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                header("Location: painel.php?mensagem=Orçamento atualizado com sucesso.");
                exit;
            } else {
                header("Location: painel.php?erro=Falha ao atualizar o orçamento.");
                exit;
            }
        } catch (PDOException $e) {
            echo "Erro ao atualizar o orçamento: " . $e->getMessage();
        }
    } else {
        header("Location: painel.php?erro=Orçamento inválido.");
        exit;
    }
} else {
    header("Location: painel.php?erro=Acesso inválido.");
    exit;
}
?>
