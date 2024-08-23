<?php

return function(string $nomeCampo, string $templateSaida = "-", string $concatenarDepois = ""): string
{
    return array_key_exists($nomeCampo, $_POST) ? $_POST[$nomeCampo].$concatenarDepois : $templateSaida;
};