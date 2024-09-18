<?php
    foreach (require_once "php/imports/configuracoes_conta.php" as $import)
        require_once $import;
    /**
     * @type ?string $msg
     * @type PDO $pdo
     * @type bool $tem_acao_no_POST
     * @type ?string $id_usuario
     */
    [$msg, $pdo, $tem_acao_no_POST, $id_usuario] =
        buscar_informacoes_request(
            fn(): PDO => get_pdo(),
            fn(): ?string => valor_salvo_no_cookie_ou_session('id') ??
                valor_salvo_no_cookie_ou_session('user_id') ??
                header("location: index.php")
        );
    $_SESSION += (array) buscar_dados_usuario($pdo, $id_usuario);
    if ($tem_acao_no_POST && $_POST['acao'] == 'Excluir') {
        excluir_usuario($pdo, $id_usuario);
        destruir_sessao();
    }
    atualizar_senha_caso_o_usuario_queira($pdo, $msg, $tem_acao_no_POST, $id_usuario,
        fn(PDO &$pdo, object $senhas, int $user_id): ?string  => atualizar_senha($pdo, $senhas, $user_id)
    );
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações</title>
    <link rel="stylesheet" href="css/index.css">
    <script src="js/configuracoes_conta.js" defer></script>
</head>
<body>
<main class="login-container">
    <img src="imgs/person.png" alt="Ícone de Usuário">
    <h2><?= $_SESSION['nome'] ?></h2>
    <section style="margin-bottom: 5vh;">
        <b>CPF:</b> <?= $_SESSION['cpf'] ?><br>
        <b>E-mail:</b> <?= $_SESSION['email'] ?>
        <a href="index.php">inicio</a>
    </section>
    <div style="margin-bottom: 3vh;">
        <button id="senha" style="background-color: #b7a200; width: 40%;">Alterar senha</button>
        <button id="excluir_conta" style="background-color: #b7293e; width: 40%; margin-left: 2vw;">Excluir Conta</button>
    </div>
    <form method="post" action="#" <?= $tem_acao_no_POST ? "" : "hidden='hidden'" ?>>
        <input type="hidden" name="acao" value="<?= $tem_acao_no_POST ? $_POST['acao'] : "Excluir" ?>">
        <?php if ($tem_acao_no_POST && $_POST['acao'] == "Alterar_senha"): ?>
            <label >
                Senha antiga
                <input type="password" name="senha_antiga">
            </label>
            <label>
                Nova senha
                <input type="password" name="nova_senha">
            </label>
            <label>
                Confirmação nova senha
                <input type="password" name="conf_nova_senha">
            </label>
            <button type="submit">Enviar</button>
            <?= !is_null($msg) ? $msg : "" ?>
        <?php endif; ?>
    </form>
</main>
</body>
</html>
