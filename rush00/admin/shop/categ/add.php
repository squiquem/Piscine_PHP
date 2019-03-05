<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    include '../../../core/core.php';

    if ( !empty($_POST['name']) &&
         !empty($_POST['desc']) &&
         isset($_POST['submit']) &&
         $_POST['submit'] === 'OK' ) {

        if  ( !core_categ_add( $_POST['name'],
                               $_POST['desc'] )) {

            $err = "Could not add category";
        }
    }
?>
<?php include '../../../layout/header.php'; ?>

        <div id="content" class="full container">
<?php
    if (isset($err)) {
        echo "\t\t\tAn error occured: <strong>" . $err . "</strong>.\n";
    }
    else {
?>
            <div id="action-form" class="wrapper">
                <h3 style="text-align: center;">Add a category</h3><hr>
                <form method="POST">
                    <input type="text" name="name" placeholder="Name"><br>
                    <input type="string" name="desc" placeholder="Description"><br>
                    <input type="submit" name="submit" value="OK">
                </form>
            </div>
<?php
    }
?>
        </div>

<?php include '../../../layout/footer.php'; ?>
