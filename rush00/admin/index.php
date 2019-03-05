<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    include '../core/core.php';
?>
<?php include '../layout/header.php'; ?>
<?php
    if ($_SESSION['is_admin'] !== TRUE) {
        header("Location: /index.php");
    }
    else {
?>
        <div id="content" class="full container">
            <div style="text-align: center;">
                <h4 style="text-align: center;">Shop Management</h4><hr>
                <a class="icon" href="shop/article/add.php">Add article</a>
                <a class="icon" href="shop/article/mod.php">Modify article</a>
                <a class="icon" href="shop/article/del.php">Remove article</a>
                <a class="icon" href="shop/categ/add.php">Add category</a>
                <a class="icon" href="shop/categ/del.php">Remove category</a>
                <a class="icon" href="shop/view.php">View orders</a>
                <h4 style="text-align: center;">User Management</h4><hr>
                <a class="icon" href="user/del.php">Remove user</a>
                <h4 style="text-align: center;">Site statistics</h4><hr>
            </div>
        </div>
<?php
    }
?>

<?php include '../layout/footer.php'; ?>
