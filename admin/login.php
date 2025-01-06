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
    <title>HEALTH SALE - Login</title>
    <style>
        /* Reset básico */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #6a11cb, #2575fc);
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .bloco {
            background: #ffffff;
            color: #333333;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            padding: 30px 20px;
            text-align: center;
        }

        .bloco h1 {
            font-size: 1.8rem;
            color: #6a11cb;
            margin-bottom: 20px;
        }

        .imag img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .login h2 {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        form p {
            margin-bottom: 15px;
            text-align: left;
        }

        form label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #666666;
        }

        form input {
            width: 100%;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            font-size: 1rem;
            outline: none;
            transition: border-color 0.3s ease;
        }

        form input:focus {
            border-color: #6a11cb;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #6a11cb;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background: #4a0eb1;
        }

        @media (max-width: 500px) {
            .bloco {
                padding: 20px 15px;
            }

            .bloco h1, .login h2 {
                font-size: 1.5rem;
            }

            form label {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="bloco">
        <h1>HEALTH SALE</h1>
        <div class="imag">
            <img src="Imagens/inicio.jpg" alt="Logo">
        </div>
        <div class="login">
            <h2>Acesse sua Conta</h2>
            <form action="" method="POST">
                <p>
                    <label for="email">E-mail</label>
                    <input type="text" name="email" id="email" placeholder="Digite seu e-mail">
                </p>
                <p>
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" id="senha" placeholder="Digite sua senha">
                </p>
                <p>
                    <button type="submit">Entrar</button>
                </p>
            </form>
        </div>
    </div>
</body>
</html>
