<?php 

$usuario = 'root';
$senha = '';
$database = 'health_sales';
$host = 'localhost';

$mysqli = new mysqli($host, $usuario, $senha, $database);
if ($mysqli->connect_error) {
    die("falha ao conectar ao banco de dados: " . $mysqli->error);
}

?>