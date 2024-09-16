<?php
    if (!isset($_POST['email'], $_POST['senha']))
        return;
    $pdo = get_pdo();
    if (!($login = confirmar_login($pdo, $_POST['email'], $_POST['senha']))) {
        $_SESSION['status'] = "não encontrado";
        return;
    }
    if (is_string($login)) {
        $_SESSION['status'] = $login;
        return;
    }
    if (isset($_POST['lembrar_de_mim']))
        setcookie("lembrar_de_mim", "", time() + 900);
    setcookie("login", "logado", time() + 900);
    setcookie("email",$_POST['email'], time() + 900);
    $_SESSION = (array) buscar_dados_usuario($pdo, $_SESSION['user_id']);
    setcookie("id", $_SESSION['user_id'], time() + 900);
    header("location: ./formulario.php");
