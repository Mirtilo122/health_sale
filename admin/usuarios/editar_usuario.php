<?php

include("../protect.php");

if ($_SESSION['acesso'] !== 'Administrador') {
    echo "<h1>Acesso Negado</h1>";
    echo "<p>Você não tem permissão para acessar esta página.</p>";
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        .success {
            color: #28a745;
            margin-bottom: 15px;
        }
        .error {
            color: #dc3545;
            margin-bottom: 15px;
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input, select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .buttons {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }
        .button {
            background: #007bff;
            color: white;
            text-decoration: none;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        .button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        include("../../conexao.php");

        $mensagem = '';
        $id = $_GET['id'] ?? null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = $_POST['usuario'] ?? '';
            $email = $_POST['email'] ?? '';
            $acesso = $_POST['acesso'] ?? '';

            if ($id && $usuario && $email && $acesso) {
                $query = "UPDATE usuarios SET usuario = :usuario, email = :email, acesso = :acesso WHERE id = :id";
                $stmt = $pdo->prepare($query);
                if ($stmt->execute([':usuario' => $usuario, ':email' => $email, ':acesso' => $acesso, ':id' => $id])) {
                    $mensagem = '<p class="success">Usuário atualizado com sucesso!</p>';
                } else {
                    $mensagem = '<p class="error">Erro ao atualizar o usuário.</p>';
                }
            } else {
                $mensagem = '<p class="error">Todos os campos são obrigatórios.</p>';
            }
        }

        if (!$id) {
            die('<p class="error">ID do usuário não especificado.</p>');
        }

        $query = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([':id' => $id]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$usuario) {
            die('<p class="error">Usuário não encontrado.</p>');
        }

        echo $mensagem;
        ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" value="<?= htmlspecialchars($usuario['usuario']); ?>" required>
            </div>

            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($usuario['email']); ?>" required>
            </div>

            <div class="form-group">
                <label for="acesso">Acesso:</label>
                <select id="acesso" name="acesso" required>
                    <option value="admin" <?= $usuario['acesso'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
                    <option value="user" <?= $usuario['acesso'] === 'user' ? 'selected' : ''; ?>>Usuário</option>
                </select>
            </div>

            <div class="buttons">
                <a href="editar_usuarios.php?id=<?= $id; ?>" class="button">Voltar</a>
                <button type="submit" class="button">Atualizar</button>
                <a href="usuarios.php" class="button">Concluir</a>
            </div>
        </form>
    </div>
</body>
</html>
