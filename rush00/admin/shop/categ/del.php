<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    include '../../../core/core.php';
?>
<?php include '../../../layout/header.php'; ?>
        <div id="content" class="full container">
            <div id="action-form" class="wrapper">
                <h3 style="text-align: center;">Delete a category</h3><hr>
                <form method="POST">
                    <input type="text" name="name" placeholder="Name"><br>
                    <input type="submit" name="submit" value="OK">
                </form>
            </div>
        </div>
<?php include '../../../layout/footer.php'; ?>
