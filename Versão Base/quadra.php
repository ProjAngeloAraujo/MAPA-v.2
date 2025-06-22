<?php
$conn = mysqli_connect("localhost", "root", "", "feira");
if (!$conn) {
    die("Erro na conexão: " . mysqli_connect_error());
}

// Conta total de projetos na Quadra
$sql = "SELECT COUNT(*) AS total FROM tbl_projetos WHERE bloco = 'Quadra'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$totalProjetos = $row['total'];

// Define quantos por grupo (ex: 8)
$porPagina = 8;
$totalPaginas = ceil($totalProjetos / $porPagina);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Quadra</title>
    <meta charset="UTF-8">
</head>
<body>
    <h1>Quadra</h1>

    <?php
    for ($i = 0; $i < $totalPaginas; $i++) {
        $inicio = $i * $porPagina + 1;
        $fim = ($i + 1) * $porPagina;
        echo "<a href='projetos.php?local=Quadra&inicio=$inicio&fim=$fim'>Projetos $inicio - $fim</a><br>";
    }
    ?>

</body>
</html>