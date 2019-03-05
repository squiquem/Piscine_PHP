<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    include 'core/core.php';

    if  ( !empty($_POST['login']) &&
          !empty($_POST['pass']) &&
          !empty($_POST['email']) &&
          !empty($_POST['submit']) &&
          $_POST['submit'] === 'OK' ) {

        if  (!core_user_add( $_POST['login'],
                             $_POST['pass'],
                             $_POST['email'],
                             FALSE )) {

            $err = "Could not create user account";
        }
        else {
            header("Location: /login.php");
            return ;
        }
    }
?>
<?php include 'layout/header.php'; ?>

        <div id="content" class="full container">
<?php
    if (isset($err)) {
        echo "\t\t\tAn error occured: <strong>" . $err . "</strong>.\n";
    }
    else {
?>
            <div id="action-form" class="wrapper container">
                <h3 style="text-align: center;">Sign up</h3><hr>
                <form method="POST">
                    <input type="text" name="login" placeholder="Username"><br>
                    <input type="password" name="pass" placeholder="Password"><br>
                    <input type="password" name="conf" placeholder="Confirm password"><br>
                    <input type="email" name="email" placeholder="E-mail address"><br>
                    <input type="submit" name="submit" value="OK">
                </form>
            </div>
<?php
    }
?>
        </div>

<?php include 'layout/footer.php'; ?>
