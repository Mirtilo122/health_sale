<?php

include("../protect.php");

include("../../conexao.php");

if ($_SESSION['acesso'] !== 'Administrador') {
    echo "<h1>Acesso Negado</h1>";
    echo "<p>Você não tem permissão para acessar esta página.</p>";
    exit;
}

$nome = $email = $senha = $acesso = '';
$mensagem = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['usuario']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);
    $acesso = trim($_POST['acesso']);

    if (empty($nome) || empty($email) || empty($senha) || empty($acesso)) {
        $mensagem = "<p style='color: red;'>Todos os campos são obrigatórios.</p>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensagem = "<p style='color: red;'>E-mail inválido.</p>";
    } else {
        $query = "INSERT INTO usuarios (usuario, email, senha, acesso) VALUES (:usuario, :email, :senha, :acesso)";
        $stmt = $pdo->prepare($query);

        try {
            $stmt->execute([
                ':usuario' => $nome,
                ':email' => $email,
                ':senha' => $senha,
                ':acesso' => $acesso
            ]);

            $mensagem = "<p style='color: green;'>Usuário cadastrado com sucesso!</p>";
            $nome = $email = $senha = $acesso = '';
        } catch (PDOException $e) {
            $mensagem = "<p style='color: red;'>Erro ao cadastrar usuário: " . $e->getMessage() . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Novo Usuário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f9;
        }
        h1 {
            text-align: center;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        .back-button {
            display: inline-block;
            margin-top: 20px;
            color: #fff;
            background-color: #007BFF;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
        }
        .back-button:hover {
            background-color: #0056b3;
        }
        .message {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Cadastrar Novo Usuário</h1>

    <?php if ($mensagem): ?>
        <div class="message"><?= $mensagem; ?></div>
    <?php endif; ?>

    <form method="POST" action="cadastrar_usuario.php">
        <label for="usuario">Nome</label>
        <input type="text" id="usuario" name="usuario" value="<?= htmlspecialchars($nome); ?>" required>

        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($email); ?>" required>

        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha" required>

        <label for="acesso">Nível de Acesso</label>
        <select id="acesso" name="acesso" required>
            <option value="" disabled selected>Selecione o nível de acesso</option>
            <option value="Administrador" <?= $acesso === 'Administrador' ? 'selected' : ''; ?>>Administrador</option>
            <option value="Gerente" <?= $acesso === 'Gerente' ? 'selected' : ''; ?>>Gerente</option>
            <option value="Agente" <?= $acesso === 'Agente' ? 'selected' : ''; ?>>Agente</option>
            <option value="Externo" <?= $acesso === 'Externo' ? 'selected' : ''; ?>>Externo</option>
        </select>

        <button type="submit">Cadastrar</button>
    </form>

    <div style="text-align: center;">
        <a href="usuarios.php" class="back-button">Voltar</a>
    </div>
</body>
</html>
