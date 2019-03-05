<?php
    if (!core_is_database_installed()) {
        header('Location: /install.php');
        die("ft_minishop is not installed!");
    }

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>ft_minishop</title>
        <meta charset="utf-8">

        <link rel="icon" type="image/png" href="favicon.png">
        <link rel="stylesheet" href="/css/default.css">
    </head>
    <body>
        <div id="header" class="full container">
            <div id="logo" class="container">
                <a href="/index.php"><h1>ft_minishop</h1></a>
            </div>
            <div id="description">
                <em>~ Only the best deals around!</em>
            </div>
            <div id="actions" class="container">
<?php
    if (isset($_SESSION['login'])) {
        $user = $_SESSION['login'];

        if  ( isset($_SESSION['is_admin']) &&
              $_SESSION['is_admin'] === TRUE ) {
            $user = "<a href=\"/admin\">$user</a>";
        }

        echo "\t\t\t\tWelcome, <strong>$user</strong>!\n";
?>
                <a href="/logout.php">Log out</a>
<?php
    }
    else {
?>
                <a href="/login.php">Log in</a> |
                <a href="/signup.php">Sign up</a>
<?php
    }
?>
            </div>
            <div id="search" class="container">
                <form action="/search.php" method="GET">
                    <input type="text" size="18" name="search" placeholder="Search for a product ...">
                </form>
            </div>
        </div>
