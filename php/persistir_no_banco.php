<?php
    function get_pdo(): PDO
    {
        $pdo = new PDO("sqlite:./resources/database.sqlite");
        $pdo->setAttribute(PDO::ERRMODE_EXCEPTION, true);
        return $pdo;
    }

    function cadastrar_usuario(PDO $pdo, object $dados_usuario): bool
    {
        try {
            $stmt = $pdo->prepare("INSERT into user(nome, email, cpf, senha, confirmar_senha) values (?, ?, ?, ?, ?)");
            return $stmt->execute(
                array_values((array) $dados_usuario)
            );
        }
        catch (PDOException){
            return false;
        }
    }

    function buscar_senhas_antigas(PDO $pdo, int $user_id): object
    {
        $pdo_stmt = $pdo->prepare("select senha, confirmar_senha from user where id = ?");
        $pdo_stmt->execute([$user_id]);
        return (object) [
            "banco" => $pdo_stmt->fetch(PDO::FETCH_OBJ)
        ];
    }

    function salvar_nova_senha_no_banco(PDO $pdo, object $senhas, int $user_id): bool
    {
        try {
            return $pdo
                ->prepare("update user(senha, confirmar_senha) set senha = ?, confirmar_senha = ? where id = ?")
                ->execute([$senhas->senha, $senhas->confirmacao, $user_id]);
        }
        catch (PDOException){
            return false;
        }

    }
    function atualizar_senha(PDO $pdo, object $senhas, int $user_id): bool
    {
        if (!password_verify($senhas->front->atual, $senhas->banco->senha) ||
            $senhas->front->nova != $senhas->front->confirmacao)
            return false;
        return salvar_nova_senha_no_banco($pdo,
            (object) [
                "senha" => password_hash($senhas->front->nova, PASSWORD_BCRYPT),
                "confirmar_senha" => password_hash($senhas->front->confirmacao, PASSWORD_BCRYPT)
            ],
            $user_id
        );
    }

    function excluir_usuario(PDO $pdo, int $user_id): bool
    {
        try {
            return $pdo
                ->prepare("delete from user where id = ?")
                ->execute([$user_id]);
        }
        catch (PDOException) {
            return false;
        }
    }