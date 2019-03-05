<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    include '../../../core/core.php';

    if ( !empty($_POST['name']) &&
         !empty($_POST['price']) &&
         !empty($_POST['url']) &&
         !empty($_POST['stock']) &&
         isset($_POST['submit']) &&
         $_POST['submit'] === 'OK' ) {

        if  ( !core_article_add( $_POST['name'],
                                $_POST['price'],
                                $_POST['url'],
                                $_POST['stock'] )) {

            $err = "Could not add article";
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
                <h3 style="text-align: center;">Add an article</h3><hr>
                <form method="POST">
                    <input type="text" name="name" placeholder="Name"><br>
                    <input type="string" name="url" placeholder="Url"><br>
                    <input type="number" name="price" placeholder="Price (€)"><br>
                    <input type="number" name="stock" placeholder="Stock"><br>
                    <input type="submit" name="submit" value="OK">
                </form>
            </div>
<?php
    }
?>
        </div>

<?php include '../../../layout/footer.php'; ?>
