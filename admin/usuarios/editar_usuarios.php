<?php
include("../protect.php");

include("../../conexao.php");


if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('ID do usuário não especificado.');
}

if ($_SESSION['acesso'] !== 'Administrador') {
    echo "<h1>Acesso Negado</h1>";
    echo "<p>Você não tem permissão para acessar esta página.</p>";
    exit;
}

$id = $_GET['id'];
$mensagem = '';


$query = "SELECT * FROM usuarios WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->execute([':id' => $id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    die('Usuário não encontrado.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario']);
    $email = trim($_POST['email']);
    $acesso = trim($_POST['acesso']);

    if (empty($usuario) || empty($email) || empty($acesso)) {
        $mensagem = "<p style='color: red;'>Todos os campos são obrigatórios.</p>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensagem = "<p style='color: red;'>E-mail inválido.</p>";
    } else {
        $query = "UPDATE usuarios SET usuario = :usuario, email = :email, acesso = :acesso WHERE id = :id";
        $stmt = $pdo->prepare($query);

        try {
            $stmt->execute([
                ':usuario' => $usuario,
                ':email' => $email,
                ':acesso' => $acesso,
                ':id' => $id
            ]);

            $mensagem = "<p style='color: green;'>Usuário atualizado com sucesso!</p>";

            $usuario['usuario'] = $usuario;
            $usuario['email'] = $email;
            $usuario['acesso'] = $acesso;
        } catch (PDOException $e) {
            $mensagem = "<p style='color: red;'>Erro ao atualizar usuário: " . $e->getMessage() . "</p>";
        }
    }
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
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .back-button {
            display: inline-block;
            margin-top: 20px;
            color: #fff;
            background-color: #28a745;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
        }
        .back-button:hover {
            background-color: #218838;
        }
        .message {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Editar Usuário</h1>

    <?php if ($mensagem): ?>
        <div class="message"><?= $mensagem; ?></div>
    <?php endif; ?>

    <form method="POST" action="editar_usuario.php?id=<?= $id; ?>">
        <label for="usuario">Usuario</label>
        <input type="text" id="usuario" name="usuario" value="<?= htmlspecialchars($usuario['usuario']); ?>" required>

        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($usuario['email']); ?>" required>

        <label for="acesso">Nível de Acesso</label>
        <select id="acesso" name="acesso" required>
            <option value="Administrador" <?= $usuario['acesso'] === 'Administrador' ? 'selected' : ''; ?>>Administrador</option>
            <option value="Gerente" <?= $usuario['acesso'] === 'Gerente' ? 'selected' : ''; ?>>Gerente</option>
            <option value="Agente" <?= $usuario['acesso'] === 'Agente' ? 'selected' : ''; ?>>Agente</option>
            <option value="Externo" <?= $usuario['acesso'] === 'Externo' ? 'selected' : ''; ?>>Acesso Externo</option>
        </select>

        <button type="submit">Salvar Alterações</button>
    </form>

    <div style="text-align: center;">
        <a href="../usuarios.php" class="back-button">Voltar</a>
    </div>
</body>
</html>
