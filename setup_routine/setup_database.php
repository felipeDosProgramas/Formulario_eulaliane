<?php
    /**
     * @param string $file_path
     * @return bool asserting if the file was created.
     */
    function create_if_not_exists(string $file_path): bool
    {
        if (file_exists($file_path))
            return true;
        fclose(fopen($file_path, "x+"));
        return false;
    }
    if (!create_if_not_exists("./resources/database.sqlite"))
