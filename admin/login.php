<?php
include("../conexao.php");

try {

    $stmt = $pdo->prepare("SELECT COUNT(*) AS total FROM usuarios");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result['total'] == 0) {
            $pass = 'admin'; 
            $sql = "INSERT INTO usuarios (usuario, email, senha, acesso) VALUES (:usuario, :email, :senha, :acesso)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':usuario' => 'Administrador',
                ':email' => 'admin',
                ':senha' => $pass,
                ':acesso' => 'Administrador'
            ]);
        }
    } catch (PDOException $e) {
        echo "Erro na conexão ou consulta: " . $e->getMessage();
}

if (isset($_POST["email"]) || isset($_POST["senha"])) {

    if (strlen($_POST["email"]) == 0) {
        echo "Preencha seu E-mail";
    } else if (strlen($_POST["senha"]) == 0) {
        echo "Preencha sua Senha";
    } else {
        require '..//conexao.php';

        $email = $_POST["email"];
        $senha = $_POST["senha"];

        try {
            $sql = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha";
            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                ':email' => $email,
                ':senha' => $senha
            ]);

            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario) {
                if (!isset($_SESSION)) {
                    session_start();
                }

                $_SESSION['id'] = $usuario['id'];
                $_SESSION['nome'] = $usuario['nome'];
                $_SESSION['acesso'] = $usuario['acesso'];

                header("Location: painel.php");
                exit;
            } else {
                echo "Falha na Autenticação! E-mail ou Senha incorretos";
            }
        } catch (PDOException $e) {
            echo "Erro na execução do código SQL: " . $e->getMessage();
        }
    }
}




?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste Banco de Dados</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div class="bloco"> 
        <h1>HEALTH SALE</h1>
        <div class="imag"><img src="Imagens/inicio.jpg" alt="Logo"></div>
        <div class="login">
            <h2>Acesse sua Conta</h2>
            <form action="" method="POST">
                <p>
                    <label>E-mail</label>
                    <input type="text" name="email" id="email">
                </p>
                <p>
                    <label>Senha</label>
                    <input type="password" name="senha" id="senha">
                </p>
                <p>
                    <button type="submit">Entrar</button>
                </p>
            </form>
            

        </div>
    </div>
</body>
</html>