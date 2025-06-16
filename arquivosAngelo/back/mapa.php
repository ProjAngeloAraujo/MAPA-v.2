<?php
#Modificado por Miguel Luiz Sommerfeld às 15:17 no dia 11/05/2025 - Team Leader (Turma B)
require_once 'connect.php';
session_start();

$tipo = $_POST['tipo'] ?? $_GET['tipo'] ?? '';
$valor = $_POST['valor'] ?? $_GET['valor'] ?? '';

if ($tipo === 'local') {
    $_SESSION['local'] = $valor;
    unset($_SESSION['sala']); // limpa sala anterior
    exit;
}

if ($tipo === 'sala') {
    $_SESSION['sala'] = $valor;
    exit;
}

if ($tipo === 'salas') {
    $local = $_SESSION['local'] ?? '';
    if ($local === 'Bloco A') {
        echo "<div class='mapa-blocoA'><div class='quadro'>📋</div>";
        for ($i = 1; $i <= 8; $i++) {
            echo "<div data-sala='Sala $i' id='sala$i' class='salaa'>Sala $i</div>";
        }
        echo "
        <div class='escadaa' id='escada1'>🪜</div>
        <div class='escadaa' id='escada2'>🪜</div>
        <div class='banheiroo' id='banheiromasc'>🚹</div>
        <div class='banheiroo' id='banheirofem'>🚺</div>
        </div>
        ";
    }elseif ($local === 'Bloco B') {
        echo "
            <div class='mapa-bloco'>
            <div class='linha-salas'>
        ";
        for ($i = 1; $i <= 6; $i++) {
            echo "<div data-sala='Sala $i' id='sala{$i}b' class='sala'>Sala $i</div>";
        }        
        echo "
            </div>
            <div class='icone tela'>💧</div>
            <div class='icone elevador'>🛗</div>
            <div class='icone escada'>🪜</div>
            <div class='icone banheiro masc' id='banheiromasc1'>🚹</div>
            <div class='icone banheiro fem' id='banheirofem1'>🚺</div>
            </div>
        ";

    } elseif ($local === 'Patio') {
        for ($i = 1; $i <= 7; $i++) {
            echo "<button data-sala='Pátio $i'>Pátio $i</button><br>";
        }
    } elseif (in_array($local, ['Biblioteca', 'Auditorio', 'Quadra'])) {
        echo "<button data-sala='$local'>$local</button><br>";
    }
    exit;
}

if ($tipo === 'stands') {
    $bloco = $_SESSION['bloco'];
    $local = $_SESSION['local'] ?? '';
    $sala = $_SESSION['sala'] ?? $local; // se sala não foi escolhida, usa o próprio local

    //Adicionando Prepared Statements, e prevenindo SQL Injection
    $query = "SELECT bloco, posicao_projeto, stand FROM tbl_projetos WHERE bloco = (?) AND sala = (?)";
    $stmt = $mysqli->prepare($query);
    
    if (!$stmt) {
        echo "<script>alert('Erro ao buscar stands.');</script>";
        echo "<script>window.history.back();</script>";
        exit;
    } else {
        $stmt->bind_param("ss", $local, $sala);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();   
    }

    $stands = [];
    while ($row = $result->fetch_assoc()) {
        $stands[$row['posicao']] = $row['stand'];
    }

    if ($local === 'Bloco A') $max = 8;
    if ($local === 'Bloco B') $max = 8;
    if ($local === 'Patio') $max = 5;
    if (in_array($local, ['Biblioteca', 'Auditorio', 'Quadra'])) $max = 16;

    if ($local === 'Patio') {
        for ($i = 1; $i <= $max; $i++) {
            $nome = $stands[$i] ?? 'Vazio';
            echo "<div class='patrocinio'>$nome</div>";
        }
    } else {
        for ($i = 1; $i <= $max; $i++) {
            $nome = $stands[$i] ?? 'Vazio';
            echo "<div class='stand'>Stand $i<br>$nome</div>";
        }
    }

    exit;
}
?>