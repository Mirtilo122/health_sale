<?php
$host = 'sql306.infinityfree.com';
$dbname = 'if0_38034104_health_sales';
$user = 'if0_38034104';
$password = '2L1Dt8ci049z';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}
?>