<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Salas - <?= htmlspecialchars($_SESSION['local'] ?? '') ?></title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $.get('api.php', { tipo: 'salas' }, function(res) {
                $('#salas').html(res);
            });

            $('#salas').on('click', 'div', function() {
                var sala = $(this).data('sala');
                $.post('api.php', { tipo: 'sala', valor: sala }, function() {
                    window.location.href = 'trabalho.php';
                });
            });

            $('#Voltar').on('click', function(e){
                e.preventDefault();
                window.location.href = 'index.php';
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
        <div class="titulo"><p class="titulo-e"><?= htmlspecialchars($_SESSION['local'] ?? '') ?></p></div>
        <main>
            <div class="home-holder">
                <div class="home-container-bloco-b" id="salas">

                </div>
            </div>
        </main>
    </section>
</body>
</html>