<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    include '../../core/core.php';
?>
<?php include '../../layout/header.php'; ?>
        <div id="content" class="full container">
            <div class="wrapper">
                <h3 style="text-align: center;">View orders</h3><hr>
<?php
    foreach (core_order_get_all() as $order) {
        echo "\t\t\t\tOrder: " . $order['id'] .
                     ' by <b>'  . $order['from'] .
                     '</b> on ' . date('D d F H:i:s', $order['date']);

        echo "\t\t\t\t<ul>\n";
        for ($i = 0; $i < count($order['products']['name']); $i++) {
            echo "\t\t\t\t\t<li>Name: <b>" . $order['products']['name'][$i] .
                 "</b> | Qty: " . $order['products']['qty'][$i] . "</li>" ;
        }
        echo "\t\t\t\t</ul>\n";
    }
?>
            </div>
        </div>
<?php include '../../layout/footer.php'; ?>
