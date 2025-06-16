<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Trabalho - <?= htmlspecialchars($_SESSION['local'] ?? '') ?> <?= isset($_SESSION['sala']) ? '- ' . htmlspecialchars($_SESSION['sala']) : '' ?></title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $.get('api.php', { tipo: 'stands' }, function(res) {
                
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
                    window.location.href = 'sala.php';
                }
                if (local == "Biblioteca" || local =="Auditorio" || local =="Quadra" || local == "Patio"){
                    e.preventDefault();
                    window.location.href = 'index.php';
                }
            });
        });
    </script>
</head>
<body>
    <header>
        <img src="images/mcm-logo.png" alt="logo-etec">
        <h1>Mapa</h1>
        <img src="images/cps-logo.png" alt="logo-cps">
    </header>
    <section id="<?= htmlspecialchars($_SESSION['local'] ?? '') ?>" class="pagina">
        <a class="voltar" id="Voltar">Voltar</a>
        <div class="titulo"><p class="titulo-e"><?= htmlspecialchars($_SESSION['local'] ?? '') ?>  <?= htmlspecialchars($_SESSION['sala'] ?? '') ?></p></div>
        <main>
            <div class="home-holder" id="Mapa">

            </div>
        </main>
    </section>
</body>
</html>