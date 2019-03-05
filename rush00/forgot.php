<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    include 'core/core.php';
?>
<?php include 'layout/header.php'; ?>

        <div id="content" class="full container">
            <div id="reset-form" class="wrapper container">
                <h3 style="text-align: center;">Reset password</h3><hr>
                <form method="POST">
                    <input type="email" name="email" placeholder="E-mail address"><br>
                    <input type="submit" name="submit" value="OK">
                    <a class="tiny-text" href="/login.php">Or go back to home</a>
                </form>
            </div>
        </div>

<?php include 'layout/footer.php'; ?>
