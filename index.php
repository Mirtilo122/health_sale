<?php
include("conexao.php");

if(isset($_POST["email"]) || isset( $_POST["password"])) {

    if(strlen($_POST["email"]) == 0) {
        echo "Preencha seu E-mail";
    } else if(strlen($_POST["senha"]) == 0) {
        echo "Preencha sua Senha";
    } else {
        $email = $mysqli->real_escape_string($_POST["email"]);
        $senha = $mysqli->real_escape_string($_POST["senha"]);

        $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade > 0) {

            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)){
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: painel.php");

        } else {
            echo "Falha na Autenticação! E-mail ou Senha incorretos";
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
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div class="bloco"> 
        <h1>LOGIN GERENCIADOR</h1>
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