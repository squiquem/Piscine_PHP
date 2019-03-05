<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    include 'core/core.php';

    session_start();

    $_SESSION = [];    // Invalidate the session
    session_destroy(); //

    header('Location: /login.php');
    return ;
?>
