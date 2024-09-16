<?php
    /**
     * @internal
     * @param string $db_location
     * @return PDO
     */
    function create_db(string $db_location): PDO
    {
        fclose(fopen($db_location, "x"));
        $pdo = new PDO("sqlite:$db_location");
        $pdo->exec("create table if not exists user(
            id integer primary key,
            nome varchar(50) not null,
            email varchar(255) not null unique,
            cpf varchar(11) not null unique,
            senha varchar(255) not null,
            confirmar_senha varchar(255) not null check 
                (
                    user.confirmar_senha = user.senha
                )
            )"
        );
        return $pdo;
    }
    /**
     * @internal
     * @return PDO
     */
    function get_pdo(): PDO
    {
        $db_location = "./resources/database.sqlite";

        $pdo = file_exists($db_location)
            ? new PDO("sqlite:$db_location")
            : create_db($db_location);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
        return $pdo;
    }

    function cadastrar_usuario(PDO &$pdo, object $dados_usuario): ?string
    {
        if(is_null($hash = hashear_senhas($dados_usuario->senha, $dados_usuario->conf_senha)))
            return "senhas diferentes";
        $dados_usuario->senha = $dados_usuario->conf_senha = $hash;
        $stmt = $pdo->prepare("INSERT into user(nome, email, cpf, senha, confirmar_senha) values (:nome, :email, :cpf, :senha, :conf_senha)");
        return !$stmt->execute((array) $dados_usuario)
            ? $stmt->errorInfo()[2]
            : null;
    }

    function salvar_nova_senha_no_banco(PDO &$pdo, object $senhas, int $user_id): ?string
    {
        $stmt = $pdo
            ->prepare("update user set senha = ?, confirmar_senha = ? where id = ?");
        return $stmt->execute([$senhas->senha, $senhas->confirmacao, $user_id])
            ? null
            : $stmt->errorInfo()[2];

    }

    /**
     * Retorna null em caso de sucesso, ou uma string com o erro;
     * @param PDO $pdo
     * @param object $senhas
     * @param int $user_id
     * @return string|null
     */
    function atualizar_senha(PDO &$pdo, object $senhas, int $user_id): ?string
    {
        return !password_verify($senhas->front->atual, $senhas->banco->senha) || $senhas->front->nova != $senhas->front->confirmacao
            ? "senhas não coincidem"
            : salvar_nova_senha_no_banco($pdo,
                (object)[
                    "senha" => $hash = password_hash($senhas->front->nova, PASSWORD_BCRYPT),
                    "confirmacao" => $hash
                ],
                $user_id
            );
    }

    function excluir_usuario(PDO &$pdo, int $user_id): bool
    {
        return $pdo
            ->prepare("delete from user where id = ?")
            ->execute([$user_id]);
    }

    function buscar_dados_usuario(PDO &$pdo, int $user_id): ?object
    {
            $stmt = $pdo->prepare("select * from user where id = ?");
            return $stmt->execute([$user_id])
                ? $stmt->fetch(PDO::FETCH_OBJ)
                : null;
    }

    function confirmar_login(PDO &$pdo, string $email, string $senha): bool|string
    {
        $stmt = $pdo->prepare("select id, email, senha from user where email = ?");
        if(!$stmt->execute([$email]))
            return $stmt->errorInfo()[2];
        if($result = $stmt->fetchAll() and count($result) != 0) {
            $_SESSION['user_id'] = $result[0]['id'];
            return password_verify($senha, $result[0]['senha']);
        }
        return false;
    }