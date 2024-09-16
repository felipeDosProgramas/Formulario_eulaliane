<?php

enum Cursos: string
{
    case DSM = "DSM";
    case GE = "GE";
    case ADS = "ADS";
    case PQ = "PQ";
    case COMEX = "COMEX";

    private static function imprimir_required_no_primeiro(bool &$imprimiu_required): string
    {
        if ($imprimiu_required)
            return "";
        $imprimiu_required = true;
        return "required";
    }
    public static function imprimir_options(): void
    {
        $required_impresso = false;
        foreach (self::cases() as $curso): ?>
            <label for="<?= $curso->value ?>">
                <input type="radio" name="curso"
                       id="<?= $curso->value ?>"
                       value="<?= $curso->value ?>"
                    <?= self::imprimir_required_no_primeiro($required_impresso) ?>
                >
                <?= $curso->value ?>
            </label>
        <?php endforeach;
    }
}
