<?php
/**
 * Testa se a chave existe no POST e, se existir,
 * retorna uma string contendo o atributo HTML value com o valor antigo
 * @param string $chave_do_valor_antigo_no_POST
 * @return string
 */
function valor_antigo_no_POST(string $chave_do_valor_antigo_no_POST): string
{
    if (array_key_exists($chave_do_valor_antigo_no_POST, $_POST))
        return "value='{$_POST[$chave_do_valor_antigo_no_POST]}'";
    return "";
}
