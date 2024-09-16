<?php
    foreach (require_once "php/imports/index.php" as $import_name)
        require_once "php/$import_name";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        <button type="submit" style="margin-bottom: 1vh; margin-top: 1vh;">Entrar</button>
        <div style="border: 1px solid gray; padding: 1vh 1vw; box-shadow: #007bff 1px 1px 2px">
            não tem uma conta? <a href="cadastro_usuario.php">Cadastre-se!</a>
        </div>
        <?php if (array_key_exists('status', $_SESSION)): ?>
            <?= $_SESSION['status'] ?>
        <?php endif; ?>
    </form>
</main>
</body>
</html>
