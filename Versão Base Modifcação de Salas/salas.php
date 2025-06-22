<?php
if (!isset($_GET['bloco'])) {
    exit("Bloco não especificado.");
}

$bloco = $_GET['bloco'];

require 'conexao.php';

$query = "SELECT DISTINCT sala FROM tbl_projetos WHERE bloco = ?";
$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_param($stmt, "s", $bloco);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Salas do Bloco <?= htmlspecialchars($bloco) ?></title>
</head>
<body>
    <h2>Salas do Bloco <?= htmlspecialchars($bloco) ?></h2>
    <ul>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <li><a href="salas.php?bloco=<?= $bloco ?>&sala=<?= urlencode($row['sala']) ?>"><?= $row['sala'] ?></a></li>
        <?php endwhile; ?>
    </ul>

<?php
// Exibir projetos da sala se informada
if (isset($_GET['sala'])):
    $sala = $_GET['sala'];

    $query2 = "SELECT * FROM tbl_projetos WHERE bloco = ? AND sala = ?";
    $stmt2 = mysqli_prepare($link, $query2);
    mysqli_stmt_bind_param($stmt2, "ss", $bloco, $sala);
    mysqli_stmt_execute($stmt2);
    $result2 = mysqli_stmt_get_result($stmt2);
?>
    <h3>Projetos da sala <?= htmlspecialchars($sala) ?></h3>
    <ul>
        <?php while ($projeto = mysqli_fetch_assoc($result2)): ?>
            <li>
                <a href="projetos.php?id=<?= $projeto['id_projetos'] ?>">
                    <?= $projeto['titulo_projeto'] ?> (<?= $projeto['stand'] ?>)
                </a>
            </li>
        <?php endwhile; ?>
    </ul>
<?php endif; ?>
</body>
</html>