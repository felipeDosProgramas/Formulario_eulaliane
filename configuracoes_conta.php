<?php
    require_once "php/manipular_banco.php";
    require_once "php/apenas_usuarios_autenticados.php";
    require_once "php/valor_salvo_no_cookie_ou_sessao.php";
    require_once "php/index/iniciar_sessao.php";
    require_once "php/configuracoes_conta/deslogar.php";

    $msg = null;
    $pdo = get_pdo();
    $tem_acao_no_POST = array_key_exists('acao', $_POST);
    $id_usuario = valor_salvo_no_cookie_ou_session('id') ??
        valor_salvo_no_cookie_ou_session('user_id') ??
        header("location: index.php");
    $_SESSION += (array) buscar_dados_usuario($pdo,
        $id_usuario
    );
    if ($tem_acao_no_POST && $_POST['acao'] == 'Excluir') {
        excluir_usuario($pdo, $id_usuario);
        destruir_sessao();
    }
    if ($tem_acao_no_POST && $_POST['acao'] == "Alterar_senha" && array_key_exists('senha_antiga', $_POST))
        $msg = atualizar_senha($pdo, (object) [
                "front" => (object) [
                    "atual" => $_POST['senha_antiga'],
                    "nova" => $_POST['nova_senha'],
                    "confirmacao" => $_POST['conf_nova_senha'],
                ],
                "banco" => (object) [ "senha" => $_SESSION['senha'] ]
        ], $id_usuario) ?? header("location: ./formulario.php");

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
