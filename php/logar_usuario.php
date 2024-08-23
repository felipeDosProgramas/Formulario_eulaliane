<?php
    if (!isset($_POST['email'], $_POST['senha']))
        return;
    if ($_POST['email'] != "emailSecreto@gmail.com" or
        $_POST['senha'] != "senhaSecreta123")
        return;
    setcookie("login", "logado", time() + 3600);
    header("location: ./formulario.php");
