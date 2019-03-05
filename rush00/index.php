<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    include 'core/core.php';

    if (!empty($_POST['id'])) {
        $_SESSION['cart'][] = $_POST['id'];
    }
?>
<?php include 'layout/header.php'; ?>

		<div id="content" class="full container">
            <div class="wrapper">
				<h3 style="text-align: center;">Product list</h3><hr>
				<table>
                    <tr>
                        <td>ID</td>
                        <td>Name</td>
                        <td>Stock</td>
                        <td>Price</td>
                    </tr>

<?php
	foreach (core_article_get_all() as $elem)
	{
?>
					<tr>
						<td><?php echo $elem['id']; ?></td>
						<td><?php echo $elem['name']; ?></td>
						<td><?php echo $elem['stock']; ?></td>
						<td><?php echo $elem['price']; ?></td>
						<td><a href="cart.php?action=add&amp;l=<?php echo $elem['name']; ?>&amp;q=1&amp;p=<?php echo $elem['price']; ?>"
							onclick="window.open(this.href, '', 'toolbar=no, location=no, directories=no, status=yes, scrollbars=yes, resizable=yes, copyhistory=no, width=600, height=350'); return false;">Add to cart !</a></td>
					</tr>
<?php
	}
?>
				</table>
            </div>
        </div>

<?php include 'layout/footer.php'; ?>
