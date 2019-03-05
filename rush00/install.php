<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    include 'core/core.php';

    session_start();

    if (!core_is_database_installed()) {
        $_SESSION = [];    // Invalidate the session
        session_destroy(); //

        if  ( !empty($_POST['dbbackend']) &&
              !empty($_POST['login']) &&
              !empty($_POST['pass']) &&
              !empty($_POST['email']) &&
              isset($_POST['submit']) &&
              $_POST['submit'] === 'INSTALL' ) {

            $res = core_install_database( $_POST['dbbackend'],
                                          $_POST['login'],
                                          $_POST['pass'],
                                          $_POST['email'] );
            if ($res !== TRUE) {
                switch ($res) {
                    case CORE_ERR_CREATE_FOLDER:
                        $err = "Couldn't create the config folders";
                        break ;
                    case CORE_ERR_CREATE_DATABASE:
                        $err = "Couldn't create the database file";
                        break ;
                    case CORE_ERR_CREATE_ACCOUNT:
                        $err = "Couldn't create the administrator user";
                        break ;
                }
            } else {
                header('Location: /login.php');
                return ;
            }
        }
    }
    else {
        $err = "ft_minishop appears to be installed already";
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>ft_minishop - Installer</title>
        <meta charset="utf-8"/>

        <link rel="icon" type="image/png" href="favicon.ico">
        <link rel="stylesheet" href="css/default.css">
    </head>
    <body>
        <div id="header" class="full container">
            <div id="logo" class="container">
                <a href="/index.php"><h1>ft_minishop</h1></a>
            </div>
            <h1 style="text-align: center;">ft_minishop installer</h1>
        </div>
        <div id="content" class="full container">
<?php
    if (isset($err)) {
        echo "\t\t\tAn error occured: <strong>" . $err . "</strong>.\n";
    }
    else {
?>
            <form id="install-form" class="wrapper" method="POST">
                <h3 style="text-align: center;">Step 1: Configure a database</h3>
                    <div class="container" style="text-align: center;">
                        <div class="radio-group">
                            <label>CSV file</label><input type="radio" name="dbbackend" value="CSV file">
                        </div>
                        <div class="radio-group">
                            <label>MySQLI</label><input type="radio" name="dbbackend" value="MySQLI" disabled="disabled">
                        </div>
                    </div>
                <h3 style="text-align: center;">Step 2: Create a first account</h3>
                    <div id="action-form" class="container">
                        <label>Username:</label><br><input type="text" name="login" placeholder="Username"><br>
                        <label>Password:</label><br><input type="password" name="pass" placeholder="Password"><br>
                        <label>Confirm password:</label><br><input type="password" name="confirm" placeholder="Confirm password"><br>
                        <label>E-mail address:</label><br><input type="email" name="email" placeholder="E-mail address">
                    </div>
                    <div class="container" style="width: 70px;">
                        <input type="submit" name="submit" value="INSTALL">
                    </div>
            </form>
<?php
    }
?>
        </div>
    </body>
</html>
