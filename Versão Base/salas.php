<?php include 'conexao.php'; ?>
<?php
$bloco = $_GET['bloco'] ?? '';
$sql = "SELECT DISTINCT sala FROM tbl_projetos WHERE bloco = '$bloco' ORDER BY sala";
$res = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Salas do Bloco <?= htmlspecialchars($bloco) ?></title>
</head>
<body>
    <h1>Bloco <?= htmlspecialchars($bloco) ?></h1>
    <?php while($row = $res->fetch_assoc()): ?>
        <a href="projetos.php?bloco=<?= urlencode($bloco) ?>&sala=<?= urlencode($row['sala']) ?>">
            Sala <?= htmlspecialchars($row['sala']) ?>
        </a><br>
    <?php endwhile; ?>
</body>
</html>