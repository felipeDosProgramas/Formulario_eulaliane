<?php

function buscar_informacoes_request(callable $instanciar_pdo, callable $buscar_dado_na_sessao): array
{
    return [
        null,
        $instanciar_pdo(),
        array_key_exists('acao', $_POST),
        $buscar_dado_na_sessao()
    ];
}

function atualizar_senha_caso_o_usuario_queira(PDO &$pdo, ?string &$msg, bool $tem_acao_no_post, ?string $id_usuario, callable $atualizar_senha): void
{
    if ($tem_acao_no_post && $_POST['acao'] == "Alterar_senha" && array_key_exists('senha_antiga', $_POST))
        $msg = $atualizar_senha($pdo, (object) [
            "front" => (object) [
                "atual" => $_POST['senha_antiga'],
                "nova" => $_POST['nova_senha'],
                "confirmacao" => $_POST['conf_nova_senha'],
            ],
            "banco" => (object) [ "senha" => $_SESSION['senha'] ]
        ], $id_usuario) ?? header("location: ./formulario.php");
}