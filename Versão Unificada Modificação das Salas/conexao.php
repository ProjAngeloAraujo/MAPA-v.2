<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "feira";

// Criando conexão
$conn = new mysqli($servername, $username, $password, $database);

// Verificando conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>