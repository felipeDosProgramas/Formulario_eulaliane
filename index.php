<?php
    declare(strict_types=1);
    if (session_status() == PHP_SESSION_NONE)
        session_start();
    require_once "php/logar_usuario.php";
    require_once "php/valor_antigo_no_POST.php";
    require_once "php/valor_salvo_no_cookie_ou_sessao.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Login</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<main class="login-container">
    <img src="imgs/person.png" alt="Ícone de Usuário">
    <h2>Área Restrita</h2>
    <form method="post" action="#">
        <input type="email" name="email" placeholder="Email"
               aria-label="Email do usuário" required
            <?= valor_antigo_no_POST('email', true)
                ?? valor_salvo_no_cookie_ou_session("email") ?>
        >
        <input type="password" name="senha" placeholder="Senha"
               aria-label="Senha do usuário" required
            <?= valor_antigo_no_POST('senha') ?>
        >
        <label>
            <input type="checkbox" name="lembrar_de_mim" style="margin-left: -7.5vw; width: 10vw">
            <span>lembrar de mim</span>
        </label>
        <button type="submit">Entrar</button>
    </form>
</main>
</body>
</html>
