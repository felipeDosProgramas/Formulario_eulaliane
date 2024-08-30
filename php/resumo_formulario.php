<?php
/**
 * Verifica se determinado campo está no array $_POST e,
 * se tiver retorna concatenado com o 3º parâmetro da função.
 * Do contrário retorna o segundo parâmetro
 * @param string $nomeCampo nome do campo para verificar se está no $_POST
 * @param string $templateSaida string para retornar caso não exista determinada chave no $_POST
 * @param string $concatenarDepois string para concatenar caso o valor seja encontrado no $_POST
 * @return string
 */
function imprime_campo_se_contiver_no_POST(string $nomeCampo, string $templateSaida = "-", string $concatenarDepois = "")
: string {
    return array_key_exists($nomeCampo, $_POST)
        ? $_POST[$nomeCampo].$concatenarDepois
        : $templateSaida;
};