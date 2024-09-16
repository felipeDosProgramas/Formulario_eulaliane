<?php
    use const DIRECTORY_SEPARATOR as DS;

    /**
     * Verifica se a chave <span color="green">"curso"</span> existe no array <b>$_POST</b>; <br>
     * Se contiver, verificará se o curso existe no enum Cursos; <br>
     * Se existir, verificará se existe um arquivo de extensão txt
     *  com esse nome no diretório de inscrições; <br>
     * Se não existir, criará um com a data e hora atual. <hr>
     * @todo mudar o retorno para bool, expressando a criação do arquivo.
     * @return void
     */
    function salvar_inscricao_em_arquivo(): void
    {
        if (!array_key_exists("curso", $_POST))
            return;
        if (is_null($curso = Cursos::tryFrom($_POST['curso'])))
            return;
        $nome_arquivo = "resources/inscricoes/$curso->value.txt";
        if (!file_exists($nome_arquivo))
            file_put_contents($nome_arquivo, date("d-m-Y H-i-s"));
    }
    /**
     * Escaneia o diretório resources/inscricoes e
     * retorna todos os arquivos com seus conteúdos.
     * @return Array<string, string>
     */
    function buscar_inscricoes_feitas(): array
    {
        $caminho_diretorio = "./resources/inscricoes";
        if(!($diretorio = scandir($caminho_diretorio))) {
            mkdir($caminho_diretorio);
            return buscar_inscricoes_feitas();
        }
        $arquivos_inscricoes = array_diff(
            $diretorio,
            ['.','..']
        );
        $inscricoes = [];
        $remover_sufixo_tipo_arquivo = fn (string $nome_arquivo): string
            => str_replace(".txt", "", $nome_arquivo);
        foreach ($arquivos_inscricoes as $arquivo_inscricao)
            $inscricoes[$remover_sufixo_tipo_arquivo($arquivo_inscricao)] = file_get_contents($caminho_diretorio.DS.$arquivo_inscricao);
        return $inscricoes;
    }