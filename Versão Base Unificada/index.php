<?php
// Conexão com banco
$conn = new mysqli("localhost", "root", "", "feira");
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$bloco = $_GET['bloco'] ?? null;
$sala = $_GET['sala'] ?? null;
$pagina = $_GET['pagina'] ?? 1;

// HTML topo
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
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Feira de Projetos</h1>
HTML;
}

// HTML rodapé
function footerHTML() {
    echo <<<HTML
</div>
</body>
</html>
HTML;
}

// Página inicial: escolher bloco
if (!$bloco && !$sala) {
    headerHTML();
    echo '<h3 class="text-center">Escolha um bloco</h3><div class="d-flex justify-content-center flex-wrap gap-4 mt-4">';
    $stmt = $conn->query("SELECT DISTINCT bloco FROM tbl_projetos ORDER BY bloco");
    while ($row = $stmt->fetch_assoc()) {
        $nome = htmlspecialchars($row['bloco']);
        echo "<a href='?bloco=" . urlencode($nome) . "' class='btn btn-primary btn-lg'>$nome</a>";
    }
    echo '</div>';
    footerHTML();
    exit;
}

// Página 2: Mostrar salas (apenas para blocos com múltiplas salas)
$blocosComSalas = ['A', 'B'];
if ($bloco && !$sala && in_array($bloco, $blocosComSalas)) {
    headerHTML();
    echo "<a href='index.php' class='btn btn-sm btn-outline-dark mb-3'>&larr; Voltar</a>";
    echo "<h3 class='mb-3'>Salas do Bloco $bloco</h3>";

    $stmt = $conn->prepare("SELECT DISTINCT sala FROM tbl_projetos WHERE bloco = ? AND sala <> '' ORDER BY sala");
    $stmt->bind_param("s", $bloco);
    $stmt->execute();
    $res = $stmt->get_result();

    echo "<div class='row'>";
    while ($row = $res->fetch_assoc()) {
        $salaNome = htmlspecialchars($row['sala']);
        echo "<div class='col-md-3 mb-3'>
                <a href='?bloco=$bloco&sala=" . urlencode($salaNome) . "' class='btn btn-outline-primary w-100'>Sala $salaNome</a>
              </div>";
    }
    echo "</div>";

    $stmt->close();
    footerHTML();
    exit;
}

// Página intermediária da quadra (separação por grupos)
if ($bloco === 'Quadra' && !$sala && !isset($_GET['pagina'])) {
    headerHTML();
    echo "<a href='index.php' class='btn btn-sm btn-outline-dark mb-3'>&larr; Voltar</a>";
    echo "<h3 class='mb-4'>Projetos na Quadra</h3>";

    $sql = "SELECT COUNT(*) AS total FROM tbl_projetos WHERE bloco = 'Quadra'";
    $res = $conn->query($sql);
    $total = $res->fetch_assoc()['total'];
    $porPagina = 8;
    $totalPaginas = ceil($total / $porPagina);

    echo "<div class='row'>";
    for ($i = 1; $i <= $totalPaginas; $i++) {
        $inicio = ($i - 1) * $porPagina + 1;
        $fim = min($i * $porPagina, $total);
        echo "<div class='col-md-3 mb-3'>
                <a href='?bloco=Quadra&pagina=$i' class='btn btn-outline-success w-100'>Projetos $inicio-$fim</a>
              </div>";
    }
    echo "</div>";
    footerHTML();
    exit;
}

// Página de projetos
if ($bloco && ($sala || in_array($bloco, ['Quadra', 'Biblioteca', 'Auditorio']))) {
    headerHTML();
    $voltarURL = in_array($bloco, ['A', 'B']) ? "?bloco=" . urlencode($bloco) : "index.php";
    echo "<a href='$voltarURL' class='btn btn-sm btn-outline-dark mb-3'>&larr; Voltar</a>";
    echo "<h3 class='mb-3'>Projetos do ";
    echo $sala ? "Bloco $bloco - Sala $sala" : "Bloco $bloco";
    echo "</h3>";

    $limit = 8;
    $offset = ($pagina - 1) * $limit;

    if ($sala) {
        $sql = "SELECT * FROM tbl_projetos WHERE bloco = ? AND sala = ? ORDER BY posicao_projeto ASC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $bloco, $sala);
    } elseif ($bloco === 'Quadra') {
        $sql = "SELECT * FROM tbl_projetos WHERE bloco = ? ORDER BY posicao_projeto ASC LIMIT ? OFFSET ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sii", $bloco, $limit, $offset);
    } else {
        $sql = "SELECT * FROM tbl_projetos WHERE bloco = ? ORDER BY posicao_projeto ASC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $bloco);
    }

    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 0) {
        echo "<div class='alert alert-warning'>Nenhum projeto encontrado.</div>";
    } else {
        echo "<div class='row'>";
        while ($row = $res->fetch_assoc()) {
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