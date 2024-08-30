<?php
    use const DIRECTORY_SEPARATOR as DS;
    /**
     * @param UnitEnum[] $cursos
     * @return void
     */
    function imprimir_options(array $cursos): void
    {
        $imprimiu_required = false;
        $imprimir_required_no_primeiro = function () use (&$imprimiu_required): string
        {
            if ($imprimiu_required)
                return "";
            $imprimiu_required = true;
            return "required";
        };
        foreach ($cursos as $curso)
        { ?>
            <label for="<?= $curso->name ?>">
                <input type="radio" name="curso"
                       id="<?= $curso->name ?>"
                       value="<?= $curso->name ?>"
                       <?= $imprimir_required_no_primeiro() ?>
                >
                <?= $curso->name ?>
            </label>
        <?php }
    }
    function salvar_inscricao_em_arquivo(Cursos $curso): void
    {
        $nome_arquivo = "resources/inscricoes/".$curso->name.".txt";
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
        $caminho_diretorio = "resources/inscricoes";
        $arquivos_inscricoes = array_diff(
            scandir($caminho_diretorio),
            ['.','..']
        );
        $inscricoes = [];
        $remover_sufixo_tipo_arquivo = fn(string $nome_arquivo): string
            => str_replace(".txt", "", $nome_arquivo);
        foreach ($arquivos_inscricoes as $arquivo_inscricao)
            $inscricoes[$remover_sufixo_tipo_arquivo($arquivo_inscricao)] = file_get_contents($caminho_diretorio.DS.$arquivo_inscricao);
        return $inscricoes;
    }