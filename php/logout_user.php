<?php
    if (!array_key_exists("logout", $_POST))
        return;
    setcookie("login","",time() - 900);
    setcookie("login", "logado", time() - 900);
    setcookie("email",$_POST['email'], time() - 900);
    session_destroy();
    header("location: index.php");