<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Mapa</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#Mapa').on('click', 'a', function() {
                var local = $(this).data('local');
                $.post('api.php', { tipo: 'local', valor: local }, function() {
                    if (local === 'Patio' || local === 'Biblioteca' || local === 'Auditorio' || local === 'Quadra') {
                        window.location.href = 'trabalho.php';
                    } else {
                        window.location.href = 'sala.php';
                    }
                });
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
    <section id="Locais" class="pagina">
    <div class="titulo"><p class="stands">Locais</p></div>
    <main>
        <div id="Mapa">
            <a href="#" data-local="Bloco A" class="btn-3 btn"><p>Bloco A</p><div class="dots-3"></div></a><br>
            <a href="#" data-local="Bloco B" class="btn-3 btn"><p>Bloco B</p><div class="dots-3"></div></a><br>
            <a href="#" data-local="Patio" class="btn-3 btn"><p>Pátio</p><div class="dots-3"></div></a><br>
            <a href="#" data-local="Biblioteca" class="btn-3 btn"><p>Biblioteca</p><div class="dots-3"></div></a><br>
            <a href="#" data-local="Auditorio" class="btn-3 btn"><p>Auditório</p><div class="dots-3"></div></a><br>
            <a href="#" data-local="Quadra" class="btn-3 btn"><p>Quadra</p><div class="dots-3"></div></a>
        </div>
    </main>
    </section>
</body>
</html>