<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    include 'core/core.php';

    if  ( !empty($_POST['login']) &&
          !empty($_POST['pass']) &&
          isset($_POST['submit']) &&
          $_POST['submit'] == 'OK' ) {

        session_start();

        if  ( core_authenticate_user( $_POST['login'],
                                      $_POST['pass'] )) {

            $user = core_user_find_by_login($_POST['login']);

            $_SESSION['login'] = $user['login'];
            $_SESSION['is_admin'] = $user['is_admin'];

            if ($_SESSION['is_admin'] === TRUE) {
                header('Location: /admin/index.php');
            }
            else {
                header('Location: /index.php');
            }

            return ;
        }
    }
?>
<?php include 'layout/header.php'; ?>

        <div id="content" class="full container">
            <div id="action-form" class="wrapper container">
                <h3 style="text-align: center;">Log in</h3><hr>
                <form method="POST">
                    <input type="text" name="login" placeholder="Username"><br>
                    <input type="password" name="pass" placeholder="Password"><br>
                    <input type="submit" name="submit" value="OK">
                    <a class="tiny-text" href="forgot.php">Forgot your password?</a>
                </form>
            </div>
        </div>

<?php include 'layout/footer.php'; ?>
