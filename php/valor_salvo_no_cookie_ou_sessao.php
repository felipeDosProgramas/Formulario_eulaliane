<?php
/**
 * @internal
 * Verifica se determinada chave existe nos cookies e, se
 * tiver, o retorna. Do contrário retorna null
 * @param string $chave
 * @return ?string
 */
function valor_salvo_no_cookie(string $chave): ?string
{
    if (!isset($_COOKIE[$chave]))
        return null;
    return $_COOKIE[$chave];
}

/**
 * @internal
 * Verifica se a sessão está ativa, e se determinada chave
 * existe na sessão, se tiver, a retorna. Do contrário retorna null
 * @param string $chave
 * @return string|null
 */
function valor_salvo_na_session(string $chave): ?string
{
    if (session_status() == PHP_SESSION_NONE)
        return null;
    if (!isset($_SESSION[$chave]))
        return null;
    return $_SESSION[$chave];
}

/**
 * @api
 * Verifica se determinada chave existe na sessão ou no cookie.
 * Do contrário retorna uma string vazia
 * @param string $chave
 * @return string
 */
function valor_salvo_no_cookie_ou_session(string $chave): string
{
    return valor_salvo_na_session($chave)
        ?? valor_salvo_no_cookie($chave)
        ?? "";
}