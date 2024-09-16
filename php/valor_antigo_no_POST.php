<?php
/**
 * Testa se a chave existe no POST e, se existir,
 * retorna uma string contendo o atributo HTML value com o valor antigo.
 * Do contrário retorna uma string vazia ou null, dependendo do segundo argumento
 * @param string $chave_do_valor_antigo_no_POST
 * @param bool $nullable
 * @return ?string
 */
function valor_antigo_no_POST(string $chave_do_valor_antigo_no_POST, bool $nullable = false): ?string
{
    return array_key_exists($chave_do_valor_antigo_no_POST, $_POST)
        ? "value='{$_POST[$chave_do_valor_antigo_no_POST]}'"
        : ($nullable ? null : "");
}
