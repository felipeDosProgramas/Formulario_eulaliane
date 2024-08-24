<?php
    if (!isset($_POST['email'], $_POST['senha']))
        return;
    if ($_POST['email'] != "emailSecreto@gmail.com" or
        $_POST['senha'] != "senhaSecreta123")
        return;
    if (isset($_POST['lembrar_de_mim']))
        setcookie("lembrar_de_mim", "", time() + 900);
    setcookie("login", "logado", time() + 900);
    setcookie("email",$_POST['email'], time() + 900);
    $_SESSION["email"] = $_POST['email'];
    header("location: ./formulario.php");
