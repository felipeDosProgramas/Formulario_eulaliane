<?php
    foreach (require_once "php/imports/Loja.php" as $import)
        require_once $import;
    $produtos = buscar_produtos();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/Loja.css">
    <title>Loja</title>
</head>
<body>
<header>
    <h4>Minha Loja</h4>
    <nav>
        <form action="#" method="post" style="width: 30vw; height: 5vh; position: absolute; top: 0;right: 0">
            <span> <?= valor_salvo_no_cookie_ou_session("email") ?> </span>
            <a href="configuracoes_conta.php" title="Configurações">
                <img src="imgs/engine.svg" alt="Configurações"
                     style="width: 2vw;margin: 0;"
                >
            </a>
            <button type="submit" name="logout" style="width: 7.5vw">Sair</button>
        </form>
    </nav>
</header>
<?php foreach($produtos as $produto): ?>

<?php endforeach; ?>
</body>
</html>
