<?php 
$filtroProjetos = isset($_POST['filtroProjetos']);
if ($filtroProjetos == 1) {
    header('Location: tela_filtro.php');
} else {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/mapa.css">
    <title>Trabalho - <?= htmlspecialchars($_SESSION['local'] ?? '') ?> <?= isset($_SESSION['sala']) ? '- ' . htmlspecialchars($_SESSION['sala']) : '' ?></title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $.get('../back/mapa.php', { tipo: 'stands' }, function(res) {
                
                let resposta = res;
                let local = "<?php echo $_SESSION['local']; ?>";
                
                if (local == "Bloco A" || local == "Bloco B") {
                    $('#Mapa').html(
                        "<div class='home-conteiner'>" +
                        "<div class='stands'>" +
                        res +
                        "</div>" +
                        "</div>"
                    );
                }

                if (local == "Patio"){
                    $('#Mapa').html(
                        "<div class='home-conteiner patio'><div class='mapa-patio'><div class='esquerda'><div class='cantina'>Cantina</div><div class='patrocinios'>" +
                        res +
                        "</div></div><div class='armarios'>Armarios</div></div>"
                        
                    );
                }

                if (local == "Biblioteca" || local =="Auditorio" || local =="Quadra"){
                    $('#Mapa').html(
                        "<div class='home-conteiner-quadra'><div class='stands'>" +
                        res +
                        "</div></div>"
                    );
                }
            });

            let local = "<?php echo $_SESSION['local']; ?>";

            $('#Voltar').on('click', function(e){
                if (local == "Bloco A" || local == "Bloco B"){
                    e.preventDefault();
                    window.history.back();
                }
                if (local == "Biblioteca" || local =="Auditorio" || local =="Quadra" || local == "Patio"){
                    e.preventDefault();
                    window.history.back();
                }
            });
        });
    </script>
</head>
<body>
    <header>
        <img src="../assets/img/mcm-logo.png" alt="logo-etec">
        <h1>Mapa</h1>
        <img src="../assets/img/cps-logo.png" alt="logo-cps">
    </header>
    <section id="<?= htmlspecialchars($_SESSION['local'] ?? '') ?>" class="pagina">
        <a href="tela_home.php" class="voltar">Voltar</a>
        <div class="titulo"><p class="titulo-e"><?= htmlspecialchars($_SESSION['local'] ?? '') ?>  <?= htmlspecialchars($_SESSION['sala'] ?? '') ?></p></div>
        <main>
            <div class="home-holder" id="Mapa">
                <?php
                $filtroProjetos = $_POST['filtroProjetos'];
                
                if($filtroProjetos == 1) : ?>
                
                <div class="container">
                    <h1>Filtrar Trabalhos</h1>

                    <form method="GET">
                        <div>
                            <label>Curso:</label>
                            <select name="curso">
                                <option value="">Todos</option>
                                <?php foreach ($cursos as $curso): ?>
                                    <option value="<?= $curso ?>" <?= $filtroCurso == $curso ? 'selected' : '' ?>>
                                        <?= strtoupper($curso) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div>
                            <label>Série:</label>
                            <select name="serie">
                                <option value="">Todas</option>
                                <?php foreach ($series as $serie): ?>
                                    <option value="<?= $serie ?>" <?= $filtroSerie == $serie ? 'selected' : '' ?>>
                                        <?= ucfirst($serie) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div>
                            <label>Bloco:</label>
                            <select name="bloco">
                                <option value="">Todos</option>
                                <?php foreach ($blocos as $bloco): ?>
                                    <option value="<?= $bloco ?>" <?= $filtroBloco == $bloco ? 'selected' : '' ?>>
                                        <?= $bloco ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div>
                            <label>Nome do Aluno:</label>
                            <input type="text" name="nome" value="<?= htmlspecialchars($filtroNome) ?>">
                        </div>

                        <div style="grid-column: span 2;">
                            <label>Tema (ODS):</label>
                            <input type="text" name="tema" value="<?= htmlspecialchars($filtroTema) ?>">
                        </div>

                        <button type="submit">Filtrar</button>
                    </form>

                    <h2>Resultados:</h2>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <div class="card">
                                <h3><?= $row['titulo'] ?></h3>
                                <p><strong>Curso:</strong> <?= strtoupper($row['curso']) ?></p>
                                <p><strong>Série:</strong> <?= ucfirst($row['serie']) ?></p>
                                <p><strong>Bloco:</strong> <?= $row['bloco'] ?></p>
                                <p><strong>Aluno:</strong> <?= htmlspecialchars($row['nome']) ?></p>
                                <p><strong>ODS:</strong> <?= htmlspecialchars($row['tema_ods']) ?></p>
                                <p><strong>RM:</strong> <?= htmlspecialchars($row['rm']) ?></p>
                                <p><strong>Orientador:</strong> <?= htmlspecialchars($row['orientador']) ?></p>
                                <p><strong>Posição no Ranking:</strong> <?= $row['posicao'] ?? '—' ?></p>
                                <p><?= nl2br(htmlspecialchars($row['descricao'])) ?></p>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>Nenhum trabalho encontrado com os filtros selecionados.</p>
                    <?php endif; ?>
                </div>
                
                <?php endif; ?>
            </div>
        </main>
    </section>
</body>
</html>