<?php
    const DADOS_OBRIGATORIOS = [
        "nome", "email", "cpf", "senha", "conf_senha"
    ];
    function organizar_dados_front(array $dados_recebidos): ?object
    {
        if(count( array_diff( array_keys($dados_recebidos), DADOS_OBRIGATORIOS)) != 0)
            return null;
        return (object) $dados_recebidos;
    }

    function retornar_com_mensagem(string $mensagem): void
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
        $_SESSION['status'] = $mensagem;
        session_write_close();
        header("location: cadastro_usuario.php");
    }

    function hashear_senhas(string $senha, string $confirmacao): ?string
    {
        return $senha != $confirmacao
            ? null
            : password_hash($senha, PASSWORD_DEFAULT);
    }