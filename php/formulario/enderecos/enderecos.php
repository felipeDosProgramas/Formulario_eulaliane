<?php
    function salvar_cache_informacoes_estado(string $nome_arquivo_cache, string $informacoes_estado): void
    {
        file_put_contents($nome_arquivo_cache, $informacoes_estado);
    }

    function retornar_cache_informacoes_estado(string $nome_arquivo_cache): object
    {
        return json_decode(
            file_get_contents($nome_arquivo_cache)
        );
    }
    function cache_informacoes_estados(string $cd_estado): object
    {
        $nome_arquivo_cache = "resources/cache_informacoes_estados/{$cd_estado}.json";
        if (file_exists($nome_arquivo_cache))
            return retornar_cache_informacoes_estado($nome_arquivo_cache);
        $informacoes_estado = file_get_contents("https://servicodados.ibge.gov.br/api/v1/localidades/estados/" . $_POST['estado']);
        salvar_cache_informacoes_estado($nome_arquivo_cache, $informacoes_estado);
        return json_decode($informacoes_estado);
    }

    /**
     * @param object[] $estados
     * @return string
     */
    function popular_select_de_estados(array $estados): string
    {
        return array_reduce($estados,
            function (string $anterior, object $atual) {
                $anterior .= "<option value='{$atual->id}'>{$atual->nome}</option>";
                return $anterior;
            },
        ""
        );
    }

    function get_nome_estado_pelo_codigo(): string
    {
        if(!array_key_exists('estado', $_POST))
            return "";
        return cache_informacoes_estados($_POST['estado'])
            ->nome.". CEP: ";
    }

    /**
     * @return Object[]
     */
    function get_estados_salvos_no_arquivo(): array
    {
        return json_decode(
            file_get_contents('resources/estados.json')
        );
    }