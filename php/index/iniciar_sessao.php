<?php
    if (session_status() == PHP_SESSION_ACTIVE)
        session_destroy();
    if (session_status() == PHP_SESSION_NONE)
        session_start();