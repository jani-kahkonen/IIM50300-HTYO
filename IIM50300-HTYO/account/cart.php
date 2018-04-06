<?php

require_once '../database/db-init.php';
require_once '../class/class.php';

session_start();

if(!isset($_SESSION['customerId']))
{
	// If not customerId, redirect to login and exit.
	header("Location: ../login.php") and exit();
}

if(isset($_SESSION['cart']))
{
	// Delete item from cart.
	if(isset($_POST['del']))
	{
		unset($_SESSION['cart'][$_POST['del']]);
		$_SESSION["cart"] = array_values($_SESSION["cart"]);
	}
	
	// Delete all items from cart.
	if(isset($_POST['empty']))
	{
		unset($_SESSION['cart']);
		$_SESSION['cart'] = null;
	}
	
	// Order all items from cart.
	if(isset($_POST['order']))
	{	
		foreach ($_SESSION['cart'] as $num => $row)
		{	
			// INSERT INTO subscription (customer_id) Values (1);
			$sth = $dbh->prepare('INSERT INTO subscription (customer_id) VALUES (:customer_id)');
			$sth->execute(array(':customer_id' => $_SESSION['customerId']));
			$subscription = $dbh->lastInsertId();
			
			// INSERT INTO product_subscription (subscription_id, product_id) VALUES (1, 1);
			$sth = $dbh->prepare('INSERT INTO product_subscription (subscription_id, product_id) VALUES (:subscription_id, :product_id)');
			$sth->execute(array(':subscription_id' => $subscription, ':product_id' => $row->getId()));
			$product_subscription = $dbh->lastInsertId();
		}
		
		unset($_SESSION['cart']);
		$num = null;
	}
}

if (!isset($_SESSION['cart']))
{
	$_SESSION['cart'] = array();
}

// Customers order history.
$statement = 'SELECT account.email, product.iname FROM product_subscription
INNER JOIN subscription on subscription.id = product_subscription.subscription_id
INNER JOIN account on account.id = subscription.customer_id
INNER JOIN product on product.id = product_subscription.product_id
WHERE subscription.customer_id = :customer_id';

$sth = $dbh->prepare($statement);
$sth->execute(array(':customer_id' => $_SESSION['customerId']));

?>

<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../styles/styles.css"> 
	</head>
	<body>
		<div id="wrapper">
			<h1>MyCart</h1>
			
			<div id="nav">
				<ul id="menu">
					<li><a href="items.php">AllProducts</a></li>
					<li><a href="cart.php" class="active">MyCart</a></li>
					<li><a href="account.php">MyAccount</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</div>
			
			<table>
				<tr>
					<th colspan="4">MyCart</th>
				</tr>
				
				<?php foreach ($_SESSION['cart'] as $num => $row){ ?>
				<tr>
					<td><?php echo $num; ?></td>
					<td><?php echo $row->getIname(); ?></td>
					<td><?php echo $row->getRdate(); ?></td>
					<td>
						<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
							<input type="hidden" name="del" value="<?php echo htmlspecialchars($num); ?>"></input>
							<input type="submit" value="Del" onclick="javascript: return confirm('Haluatko poistaa tuotteen ostoskorista?')"></input>
						</form>
					</td>
				</tr>
				<?php } ?>

				<tr>
					<td colspan="3"><a>Tuotteita yhteensä:</a><a><?php echo (isset($num) ? ++$num : 0); ?></a></td>
					<td>
						<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
							<input type="submit" name="empty" value="Empty" onclick="javascript: return confirm('Haluatko tyhjentää ostoskorin?')"></input>
							<input type="submit" name="order" value="Order" onclick="javascript: return confirm('Haluatko tilata ostoskorin sisällön?')"></input>
						</form>
					</td>
				</tr>
				
				<tr>
					<th colspan="4">MyOrders</th>
				</tr>
				
				<?php for($num = 0; $row = $sth->fetchObject("Item"); ++$num){ ?>
				<tr>
					<td><?php echo $num; ?></td>
					<td colspan="3"><?php echo $row->getIname(); ?></td>
				</tr>
				<?php } ?>

				<tr>
					<td colspan="4"><a>Tuotteita yhteensä:</a><a><?php echo (isset($num) ? $num : 0); ?></a></td>
				</tr>
			</table>
		</div>
	</body>
</html>