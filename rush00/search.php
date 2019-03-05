<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    include 'core/core.php';
?>
<?php include 'layout/header.php'; ?>

        <div id="content" class="full container">
            <div class="wrapper">
<?php
    if (!empty($_GET['search'])) {
?>
                <h3 style="text-align: center;">Articles found</h3><hr>
<?php
        $articles = array_filter(core_article_get_all(), function($item) {
            return strtolower($item['name']) == strtolower($_GET['search']);
        });

        foreach($articles as $article) {
            echo $article['name'] . ' | ' . $article['price'] . ' | ' . $article['stock'] . "<br>\n";
        }
    }
    else {
        echo "\t\t\t\tPlease input a search term.\n";
    }
?>
            </div>
        </div>

<?php include 'layout/footer.php'; ?>
