<?php
// CONEXÃO COM BANCO
$servername = "localhost";
$username = "root";
$password = "";
$database = "feira";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// PEGAR PARÂMETROS
$bloco = $_GET['bloco'] ?? null;
$sala = $_GET['sala'] ?? null;
$pagina = $_GET['pagina'] ?? 1;

// HTML: TOPO
function headerHTML() {
    echo <<<HTML
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Feira de Projetos</title>
    <link href="style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h1 class="text-center mb-4">Feira de Projetos</h1>
HTML;
}

// HTML: RODAPÉ
function footerHTML() {
    echo <<<HTML
</div>
</body>
</html>
HTML;
}

// PÁGINA 1 — ESCOLHA DE BLOCO
if (!$bloco && !$sala) {
    headerHTML();
    echo '<h3 class="text-center">Escolha um bloco</h3><div class="d-flex justify-content-center gap-4 mt-4">';
    echo '<a href="?bloco=A" class="btn btn-primary btn-lg">Bloco A</a>';
    echo '<a href="?bloco=B" class="btn btn-secondary btn-lg">Bloco B</a>';
    echo '</div>';
    footerHTML();
    exit;
}

// PÁGINA 2 — SALAS DO BLOCO
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

// TELA INTERMEDIÁRIA — QUADRA
if ($bloco && isset($_GET['sala']) && $sala === 'Quadra' && !isset($_GET['pagina'])) {
    headerHTML();
    echo "<a href='?bloco=$bloco' class='btn btn-sm btn-outline-dark mb-3'>&larr; Voltar para salas</a>";
    echo "<h3 class='mb-4'>Projetos na Quadra</h3>";

    $stmt = $conn->prepare("SELECT COUNT(*) as total FROM tbl_projetos WHERE bloco = ? AND sala = ?");
    $stmt->bind_param("ss", $bloco, $sala);
    $stmt->execute();
    $result = $stmt->get_result();
    $total = $result->fetch_assoc()['total'];
    $stmt->close();

    $grupos = ceil($total / 8);
    echo "<div class='row'>";
    for ($i = 1; $i <= $grupos; $i++) {
            $inicio = (($i - 1) * 8) + 1;
            $fim = min($i * 8, $total);
            echo "<div class='col-md-3 mb-3'>
            <a href='?bloco=$bloco&sala=Quadra&pagina=$i' class='btn btn-outline-success w-100'>Projetos " . $inicio . "-" . $fim . "</a>
            </div>";
    }

    echo "</div>";
    footerHTML();
    exit;
}

// PÁGINA 3 — PROJETOS DA SALA (QUALQUER SALA)
if ($bloco && $sala) {
    headerHTML();
    echo "<a href='?bloco=$bloco' class='btn btn-sm btn-outline-dark mb-3'>&larr; Voltar para salas</a>";
    echo "<h3 class='mb-3'>Projetos da Sala $sala (Bloco $bloco)</h3>";

    $limit = 8;
    $offset = ($pagina - 1) * $limit;

    $stmt = $conn->prepare("SELECT titulo_projeto, descricao_projeto, ods, stand, prof_orientador FROM tbl_projetos WHERE bloco = ? AND sala = ? ORDER BY posicao_projeto ASC LIMIT ? OFFSET ?");
    $stmt->bind_param("ssii", $bloco, $sala, $limit, $offset);
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