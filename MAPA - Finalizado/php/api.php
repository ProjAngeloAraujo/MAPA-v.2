<?php
session_start();

$tipo = $_POST['tipo'] ?? $_GET['tipo'] ?? '';
$valor = $_POST['valor'] ?? $_GET['valor'] ?? '';

$link = mysqli_connect("localhost", "root", "", "Feira");
if (!$link) {
    exit('Erro na conexão com o banco.');
}

if ($tipo === 'local') {
    $_SESSION['local'] = $valor;
    unset($_SESSION['sala']); // limpa sala anterior
    echo 'ok';
    exit;
}

if ($tipo === 'sala') {
    $_SESSION['sala'] = $valor;
    echo 'ok';
    exit;
}

if ($tipo === 'salas') {
    $local = $_SESSION['local'] ?? '';
    if ($local === 'Bloco A') {
        echo "
            <div class='mapa-blocoA'>
            <div class='quadro'>📋</div>
        ";
        for ($i = 1; $i <= 8; $i++) {
            echo "
            <div data-sala='Sala $i' id='sala$i' class='salaa'>Sala $i</div>
            ";
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
            echo "
            <div data-sala='Sala $i' id='sala{$i}b' class='sala'>Sala $i</div>
            ";
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
    $local = $_SESSION['local'] ?? '';
    $sala = $_SESSION['sala'] ?? $local; // se sala não foi escolhida, usa o próprio local

    $query = "SELECT posicao, nome_stand FROM stand WHERE bloco = '$local' AND sala = '$sala'";
    $res = mysqli_query($link, $query);
    if (!$res) {
        echo "Erro ao buscar stands.";
        exit;
    }

    $stands = [];
    while ($row = mysqli_fetch_assoc($res)) {
        $stands[$row['posicao']] = $row['nome_stand'];
    }
    $max = 8;

    if ($local === 'Bloco A') $max = 8;
    if ($local === 'Bloco B') $max = 8;
    if ($local === 'Patio') $max = 5;
    if (in_array($local, ['Biblioteca', 'Auditorio', 'Quadra'])) $max = 16;

    if ($local === 'Patio'){
        for ($i = 1; $i <= $max; $i++) {
            $nome = $stands[$i] ?? 'Vazio';
            echo "<div class='patrocinio'>$nome</div>";
        }
    } else {
        for ($i = 1; $i <= $max; $i++) {
            $nome = $stands[$i] ?? 'Stand vazio';
            echo "<div class='stand'>Stand $i<br>$nome</div>";
        }
    }
    

    exit;
}
?>