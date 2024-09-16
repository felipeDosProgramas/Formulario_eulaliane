<?php
    /**
     * @param string $name The name attribute of the input.
     * @param string $placeholder The placeholder text.
     * @param string $a_label The aria-label for accessibility.
     * @param ?string $value The default value of the input.
     * @param bool $required Whether the input is required.
     * @param string $type The type of the input.
     * @return void
     */
    function input(string $name, string $placeholder, string $a_label, ?string $value = null, bool $required = true, string $type = "text"): void {
        $r = fn(string $t): string => htmlspecialchars($t);
        ?>
            <input type="<?= $type ?>"
                   name="<?= $name ?>"
                   placeholder="<?= $placeholder ?>"
                   aria-label="<?= $a_label ?>"
                <?= $required ? "required" : "" ?>
                <?= !is_null($value) ? "value='{${$r($value)}}'" : ''?>
            >
        <?php
    }
?>