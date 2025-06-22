<?php
if (!isset($_GET['id'])) {
    exit("Projeto não especificado.");
}

$id = $_GET['id'];

require 'conexao.php';

$query = "SELECT * FROM tbl_projetos WHERE id_projetos = ?";
$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($projeto = mysqli_fetch_assoc($result)):
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($projeto['titulo_projeto']) ?></title>
</head>
<body>
    <h2><?= $projeto['titulo_projeto'] ?></h2>
    <p><strong>Professor orientador:</strong> <?= $projeto['prof_orientador'] ?></p>
    <p><strong>Descrição:</strong> <?= $projeto['descricao_projeto'] ?></p>
    <p><strong>ODS:</strong> <?= $projeto['ods'] ?></p>
    <p><strong>Local:</strong> Bloco <?= $projeto['bloco'] ?> - Sala <?= ucfirst($projeto['sala']) ?></p>
    <p><strong>Stand:</strong> <?= $projeto['stand'] ?></p>
</body>
</html>

<?php else: ?>
    Projeto não encontrado.
<?php endif; ?>