<?php
$conn = mysqli_connect("localhost", "root", "", "feira");
if (!$conn) {
    die("Erro na conexão: " . mysqli_connect_error());
}

$local = isset($_GET['local']) ? $_GET['local'] : null;

if ($local) {
    $inicio = isset($_GET['inicio']) ? (int) $_GET['inicio'] : 0;
    $fim = isset($_GET['fim']) ? (int) $_GET['fim'] : 1000;

    $sql = "SELECT * FROM tbl_projetos 
            WHERE bloco = '" . $conn->real_escape_string($local) . "' 
            AND posicao_projeto BETWEEN $inicio AND $fim 
            ORDER BY posicao_projeto";
} else {
    $bloco = isset($_GET['bloco']) ? $_GET['bloco'] : '';
    $sala = isset($_GET['sala']) ? $_GET['sala'] : '';
    $sql = "SELECT * FROM tbl_projetos 
            WHERE bloco = '" . $conn->real_escape_string($bloco) . "' 
            AND sala = '" . $conn->real_escape_string($sala) . "' 
            ORDER BY posicao_projeto";
}

$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Projetos</title>
    <meta charset="UTF-8">
</head>
<body>
    <h1>Projetos</h1>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div>
                <h2><?php echo htmlspecialchars($row['titulo_projeto']); ?></h2>
                <p><?php echo htmlspecialchars($row['descricao_projeto']); ?></p>
                <p><strong>Stand:</strong> <?php echo htmlspecialchars($row['stand']); ?></p>
                <p><strong>ODS:</strong> <?php echo htmlspecialchars($row['ods']); ?></p>
                <p><strong>Orientador:</strong> <?php echo htmlspecialchars($row['prof_orientador']); ?></p>
                <hr>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Nenhum projeto encontrado.</p>
    <?php endif; ?>

    <?php mysqli_close($conn); ?>
</body>
</html>