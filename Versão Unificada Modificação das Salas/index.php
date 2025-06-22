<?php
include 'conexao.php';

$bloco = $_GET['bloco'] ?? null;
$sala = $_GET['sala'] ?? null;

function headerHTML() {
    echo <<<HTML
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Feira de Projetos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h1 class="text-center mb-4">Feira de Projetos</h1>
HTML;
}

function footerHTML() {
    echo <<<HTML
</div>
</body>
</html>
HTML;
}

// Página 1: Escolher bloco
if (!$bloco && !$sala) {
    headerHTML();
    echo '<h3 class="text-center">Escolha um bloco</h3><div class="d-flex justify-content-center gap-4 mt-4">';
    echo '<a href="?bloco=A" class="btn btn-primary btn-lg">Bloco A</a>';
    echo '<a href="?bloco=B" class="btn btn-secondary btn-lg">Bloco B</a>';
    echo '</div>';
    footerHTML();
    exit;
}

// Página 2: Salas do bloco escolhido
if ($bloco && !$sala) {
    headerHTML();
    echo "<a href='index.php' class='btn btn-sm btn-outline-dark mb-3'>&larr; Voltar</a>";
    echo "<h3 class='mb-3'>Salas do Bloco $bloco</h3>";

    $stmt = $conn->prepare("SELECT DISTINCT sala FROM tbl_projetos WHERE bloco = ? ORDER BY sala ASC");
    $stmt->bind_param("s", $bloco);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<div class='row'>";
    while ($row = $result->fetch_assoc()) {
        $salaNome = htmlspecialchars($row['sala']);
        echo "<div class='col-md-3 mb-3'>
                <a href='?bloco=$bloco&sala=" . urlencode($salaNome) . "' class='btn btn-outline-primary w-100'>$salaNome</a>
              </div>";
    }
    echo "</div>";

    $stmt->close();
    footerHTML();
    exit;
}

// Página 3: Projetos da sala
if ($bloco && $sala) {
    headerHTML();
    echo "<a href='?bloco=$bloco' class='btn btn-sm btn-outline-dark mb-3'>&larr; Voltar para salas</a>";
    echo "<h3 class='mb-3'>Projetos da Sala $sala (Bloco $bloco)</h3>";

    $stmt = $conn->prepare("SELECT titulo_projeto, descricao_projeto, ods, stand, prof_orientador FROM tbl_projetos WHERE bloco = ? AND sala = ? ORDER BY posicao_projeto ASC");
    $stmt->bind_param("ss", $bloco, $sala);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo "<div class='alert alert-warning'>Nenhum projeto encontrado para essa sala.</div>";
    } else {
        echo "<div class='row'>";
        while ($row = $result->fetch_assoc()) {
            echo "<div class='col-md-6 mb-4'>
                    <div class='card h-100'>
                        <div class='card-body'>
                            <h5 class='card-title'>{$row['titulo_projeto']}</h5>
                            <p class='card-text'>{$row['descricao_projeto']}</p>
                            <p><strong>ODS:</strong> {$row['ods']}</p>
                            <p><strong>Stand:</strong> {$row['stand']}</p>
                            <p><strong>Orientador:</strong> {$row['prof_orientador']}</p>
                        </div>
                    </div>
                  </div>";
        }
        echo "</div>";
    }

    $stmt->close();
    footerHTML();
    exit;
}
?>