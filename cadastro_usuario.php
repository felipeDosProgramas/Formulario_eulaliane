<?php
    foreach (require_once "php/imports/cadastro_usuario.php" as $import)
        require_once "php/$import";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/index.css">
    <script defer src="js/cadastro_usuario.js"></script>
</head>
<body>
    <main class="login-container">
        <img src="imgs/person.png" alt="Ícone de Usuário">
        <h2>Cadastro</h2>
        <form method="post" action="mov_cadastro_usuario.php">
            <?php  input("nome", "Nome", "Nome do usuário", valor_antigo_no_POST("nome", true)); ?>
            <?php  input("cpf", "CPF", "CPF do usuário", valor_antigo_no_POST("cpf", true)); ?>
            <?php  input("email", "Email", "email do usuário", valor_antigo_no_POST("email", true), type: "email"); ?>
            <?php  input("senha", "Senha", "Senha do usuário", valor_antigo_no_POST("Senha", true), type: "password"); ?>
            <?php  input("conf_senha", "Confirmar senha", "Confirmar senha do usuário", valor_antigo_no_POST("conf_senha", true), type: "password"); ?>
            <button type="submit">Entrar</button>
        </form>
        <?php if (array_key_exists('status',$_SESSION)): ?>
            <div>
                <?= $_SESSION['status'] ?>
            </div>
        <?php endif; ?>
        <a href="index.php">inicio</a>
    </main>
</body>
</html>

