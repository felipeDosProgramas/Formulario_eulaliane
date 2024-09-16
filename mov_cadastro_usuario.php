<?php
    require_once "php/manipular_banco.php";
    require_once "php/cadastro_usuario/cadastrar.php";

    $pdo = get_pdo();
    $dados_recebidos = organizar_dados_front($_POST);
    if (is_null($dados_recebidos)) {
        retornar_com_mensagem("dados errados ou faltantes");
    }
    !is_null( $cadastro = cadastrar_usuario(
            $pdo,
            $dados_recebidos
        )
    )
        ? retornar_com_mensagem($cadastro)
        : retornar_com_mensagem("cadastrado com sucesso");
