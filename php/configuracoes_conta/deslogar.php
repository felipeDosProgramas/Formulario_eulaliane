<?php
    function destruir_sessao(): void
    {
        session_destroy();
        setcookie("login", "logado", time() - 900);
        setcookie("email", $_COOKIE['email'], time() - 900);
        setcookie("id", $_COOKIE['id'], time() - 900);
        header("location: ./");
    }