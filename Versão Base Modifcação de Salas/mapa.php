<?php
$link = mysqli_connect("localhost", "root", "", "feira");
if (!$link) {
    exit("Erro ao conectar com o banco de dados.");
}

// Pega todos os projetos
$query = "SELECT * FROM tbl_projetos";
$result = mysqli_query($link, $query);

$projetos = [];
while ($row = mysqli_fetch_assoc($result)) {
    $projetos[] = $row;
}
?>
<h2>Mapa Geral da Feira</h2>
<ul>
<?php foreach ($projetos as $proj): ?>
    <li>
        <a href="projetos.php?id=<?= $proj['id'] ?>">
            <?= $proj['titulo'] ?> - <?= ucfirst($proj['bloco']) ?> - <?= ucfirst($proj['sala']) ?> - Posição <?= $proj['posicao_projeto'] ?>
        </a>
    </li>
<?php endforeach; ?>
</ul>