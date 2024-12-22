<?php

include("../protect.php");

include("../../conexao.php");

if (!defined('BASE_PATH')) {
    define('BASE_PATH', __DIR__ . '/../');
}

if (!defined('BASE_URL')) {
    define('BASE_URL', '/admin/');
}


if ($_SESSION['acesso'] !== 'Administrador') {
    echo "<h1>Acesso Negado</h1>";
    echo "<p>Você não tem permissão para acessar esta página.</p>";
    exit;
}

$sort_column = isset($_GET['sort']) ? $_GET['sort'] : 'id';
$order = isset($_GET['order']) && $_GET['order'] === 'desc' ? 'DESC' : 'ASC';

$allowed_columns = ['id', 'usuario', 'email', 'acesso'];
if (!in_array($sort_column, $allowed_columns)) {
    $sort_column = 'id';
}

$query = "SELECT id, usuario, email, acesso FROM usuarios ORDER BY $sort_column $order";
$stmt = $pdo->query($query);



function toggleOrder($current_order) {
    return $current_order === 'asc' ? 'desc' : 'asc';
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Usuários</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f9;
        }
        h1 {
            text-align: center;
        }
        .button {
            display: inline-block;
            padding: 10px 15px;
            margin-bottom: 20px;
            color: #fff;
            background-color: #007BFF;
            text-decoration: none;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            margin-top: 10px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th a {
            text-decoration: none;
            color: #007BFF;
        }
        th a:hover {
            text-decoration: underline;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .edit-button {
            color: #fff;
            background-color: #28a745;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 5px;
        }
        .edit-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <h1>Gerenciamento de Usuários</h1>

    <a href="cadastrar_usuario.php" class="button">Cadastrar Novo Usuário</a>

    <table>
        <thead>
            <tr>
                <th>
                    <a href="?sort=id&order=<?= toggleOrder($order); ?>">ID</a>
                </th>
                <th>
                    <a href="?sort=usuario&order=<?= toggleOrder($order); ?>">Nome</a>
                </th>
                <th>E-mail</th>
                <th>
                    <a href="?sort=acesso&order=<?= toggleOrder($order); ?>">Nível de Acesso</a>
                </th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($stmt->rowCount() > 0): ?>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']); ?></td>
                        <td><?= htmlspecialchars($row['usuario']); ?></td>
                        <td><?= htmlspecialchars($row['email']); ?></td>
                        <td><?= htmlspecialchars($row['acesso']); ?></td>
                        <td>
                        <a href="editar_usuarios.php?id=<?= $row['id']; ?>" class="edit-button">Editar Cadastro</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Nenhum usuário encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
