<?php
function cart_creation()
{
	if (!isset($_SESSION['cart']))
	{
		$_SESSION['cart'] = array();
		$_SESSION['cart']['id'] = array();
		$_SESSION['cart']['name'] = array();
		$_SESSION['cart']['qty'] = array();
		$_SESSION['cart']['price'] = array();
		$_SESSION['cart']['lock'] = false;
	}
	return true;
}

function add_item($name, $qty, $price)
{
	if (cart_creation() && !is_locked())
	{
		$item_position = array_search($name, $_SESSION['cart']['name']);
		if ($item_position !== false)
			$_SESSION['cart']['qty'][$item_position] += $qty;
		else
		{
			array_push( $_SESSION['cart']['id'], core_article_find_by_name($name)['id']);
			array_push( $_SESSION['cart']['name'], $name);
			array_push( $_SESSION['cart']['qty'], $qty);
			array_push( $_SESSION['cart']['price'], $price);
		}
	}
	else
		echo "A problem has occurered, please contact the admin.";
}

function delete_item($name)
{
	if (cart_creation() && !is_locked())
	{
		$tmp = array();
		$tmp['id'] = array();
		$tmp['name'] = array();
		$tmp['qty'] = array();
		$tmp['price'] = array();
		$tmp['lock'] = $_SESSION['cart']['lock'];

		for ($i = 0; $i < count($_SESSION['cart']['name']); $i++)
		{
			if ($_SESSION['cart']['name'][$i] !== $name)
			{
				array_push($tmp['id'], $_SESSION['cart']['id'][$i]);
				array_push($tmp['name'], $_SESSION['cart']['name'][$i]);
				array_push($tmp['qty'], $_SESSION['cart']['qty'][$i]);
				array_push($tmp['price'], $_SESSION['cart']['price'][$i]);
			}
		}
		$_SESSION['cart'] = $tmp;
		unset($tmp);
	}
	else
		echo "A problem has occurered, please contact the admin.";
}

function delete_one($name)
{
	if (cart_creation() && !is_locked())
	{
		for ($i = 0; $i < count($_SESSION['cart']['name']); $i++)
		{
			if ($_SESSION['cart']['name'][$i] == $name && $_SESSION['cart']['qty'][$i] == 1)
				delete_item($name);
			else if ($_SESSION['cart']['name'][$i] == $name && $_SESSION['cart']['qty'][$i] !== 0)
				$_SESSION['cart']['qty'][$i] -= 1;
		}
	}
	else
		echo "A problem has occurered, please contact the admin.";
}

function add_one($name)
{
	if (cart_creation() && !is_locked())
	{
		for ($i = 0; $i < count($_SESSION['cart']['name']); $i++)
		{
			if ($_SESSION['cart']['name'][$i] == $name)
				$_SESSION['cart']['qty'][$i] += 1;
			$i++;
		}
	}
	else
		echo "A problem has occurered, please contact the admin.";
}

function modify_qty($name, $qty)
{
	if (cart_creation() && !is_locked())
	{
		if ($qty > 0)
		{
			$item_position = array_search($name, $_SESSION['cart']['name']);
			if ($item_position !== false)
				$_SESSION['cart']['qty'] = $qty;
		}
		else
			delete_item($name);
	}
	else
		echo "A problem has occurered, please contact the admin.";
}

function total_price()
{
	$total = 0;
	for ($i = 0; $i < count($_SESSION['cart']['name']); $i++)
		$total += $_SESSION['cart']['qty'][$i] * $_SESSION['cart']['price'][$i];
	return $total;
}

function is_locked()
{
	if (isset($_SESSION['cart']) && $_SESSION['cart']['lock'])
		return true;
	else
		return false;
}

function count_item()
{
	if (isset($_SESSION['cart']))
		return count($_SESSION['cart']['name']);
	else
		return 0;
}

function delete_cart()
{
	unset($_SESSION['cart']);
}

function buy($user, $array)
{
	core_order_add($user, $array);
}
?>

<?php include 'core/core.php'; ?>
<?php include 'layout/header.php'; ?>

<?php
$erreur = false;
$action = (isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action']:null));
if ($action !== null)
{
	if (!in_array($action, array('add', 'delete', 'refresh', 'add_one', 'delete_one', 'buy')))
		$erreur = true;

	// variables en POST ou GET
	$l = (isset($_POST['l']) ? $_POST['l'] : (isset($_GET['l']) ? $_GET['l'] : null));
	$p = (isset($_POST['p']) ? $_POST['p'] : (isset($_GET['p']) ? $_GET['p'] : null));
	$q = (isset($_POST['q']) ? $_POST['q'] : (isset($_GET['q']) ? $_GET['q'] : null));

	// suppression des espaces verticaux
	 $l = preg_replace('#\v#', '', $l);
	// $p float?
	$p = floatval($p);

	// traitement de $q qui peut etre un entier ou un tableau d'entier
	if (is_array($q))
	{
		$qty = array();
		$i = 0;
		foreach ($q as $content)
			$qty[$i++] = intval($content);
	}
	else
		$q = intval($q);
}

//if ($_POST['action'] === 'buy')
//{
//	if (isset($_SESSION['login']))
//		buy($_SESSION['login'], $_SESSION['cart']);
//}

if (!$erreur)
{
	switch($action)
	{
		case "add":
			add_item($l, $q, $p);
			break;

		case "delete":
			delete_item($l);
			break;

		case "add_one":
			add_one($l);
			break;

		case "delete_one":
			delete_one($l);
			break;

		case "refresh":
			for ($i = 0; $i < count($qty); $i++)
				modify_qty($_SESSION['cart']['name'][$i], round($qty[$i]));
			break;

		case "buy":
			if (isset($_SESSION['login']))
				buy($_SESSION['login'], $_SESSION['cart']);
			break;

		Default:
			break;
	}
}
?>

<div id='content' class='full container'>
<form method='post' action='cart.php'>
	<table style='width: 400px'>
		<tr>
			<td colspan="4">Your cart</td>
		</tr>
		<tr>
			<td>ID</td>
			<td>Name</td>
			<td>Qty</td>
			<td>Price</td>
			<td>Action</td>
		</tr>
<?php
if (cart_creation())
{
	$nb_items = count($_SESSION['cart']['name']);
	if ($nb_items <= 0)
		echo "<tr><td>Your cart is empty</td></tr>";
	else
	{
		for ($i = 0; $i < $nb_items; $i++)
		{
?>
			<tr>
				<td><?php echo htmlspecialchars($_SESSION['cart']['id'][$i]); ?></td>
				<td><?php echo htmlspecialchars($_SESSION['cart']['name'][$i]); ?></td>
				<td><input type="text" size="4" name="q[]" value="<?php echo htmlspecialchars($_SESSION['cart']['qty'][$i]); ?>"/></td>
				<td><?php echo htmlspecialchars($_SESSION['cart']['price'][$i]); ?></td>
				<td><a href="<?php echo htmlspecialchars("cart.php?action=delete&l=".rawurlencode($_SESSION['cart']['name'][$i])); ?>">Remove all</a></td>
				<td><a href="<?php echo htmlspecialchars("cart.php?action=delete_one&l=".rawurlencode($_SESSION['cart']['name'][$i])); ?>">Remove one</a></td>
				<td><a href="<?php echo htmlspecialchars("cart.php?action=add_one&l=".rawurlencode($_SESSION['cart']['name'][$i])); ?>">Add one</a></td>
			</tr>
<?php
		}
?>
			<tr>
				<td colspan="2">Total:</td>
				<td colspan="2"> <?php echo total_price(); ?></td>
			</tr>

		<tr><td colspan="4">
		<input type="submit" name="action" value="refresh"/>
		<a href="<?php echo htmlspecialchars("cart.php?action=buy"); ?>">BUY</a>
		</td></tr>
<?php
	}
}
?>
</table>
</form>
</div>

<?php include 'layout/footer.php'; ?>
