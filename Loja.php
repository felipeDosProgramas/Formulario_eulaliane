<?php
    foreach (require_once "php/imports/Loja.php" as $import)
        require_once $import;    
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
<main>
    <?php foreach(buscar_produtos() as $produto): ?>
        <section title="<?= $produto->title ?>">
            <div class="parteCimaSection">
                <div class="oferta">Oferta do dia</div>
                <div class="desconto">50%</div>
            </div>
            <span class="categoria">
                <?= $produto->category ?>
            </span>
            <img src="<?= $produto->image ?>" alt="<?= $produto->title ?>" class="fotoProduto">
            <span class="precoAntigo">
                <?= $produto->price * rand(1, 2) ?>
            </span>            
            <div class="nomePreco">                
                <span class="nome">
                    <?= $produto->title ?>
                </span>
                <span class="preco">
                    <?= $produto->price ?>
                </span>
            </div>
            <div class="vendidos">
                Vendidos: <?= $produto->rating->count ?>
            </div>
            <div class="avaliacao"> 
                <span><?= $produto->rating->rate ?></span>                
                <?php for($x = 0;$x!=(int) $produto->rating->rate;$x++): ?>
                    <img src="imgs/estrela.svg" width="15px">
                <?php endfor; ?>
                <img src="imgs/metade_estrela.svg" width="15px"> 
            </div>
        </section>
    <?php endforeach; ?>
</main>
</body>
</html>
