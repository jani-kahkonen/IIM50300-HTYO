<?php

require_once 'db-init.php';
require_once 'class.php';

session_start();

function fetchObject($sql, $param, $class, $dbh)
{
	$sth = $dbh->prepare($sql);
	$sth->execute($param);
	return $sth->fetchObject($class);
}

$customer = fetchObject('SELECT * FROM customer WHERE id=:id', array(':id' => $_SESSION['customerId']), 'Customer', $dbh);

$account = fetchObject('SELECT * FROM account WHERE customer_id=:id', array(':id' => $_SESSION['customerId']), 'Account', $dbh);

$customer->setAccount($account);

?>

<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="styles.css"> 
	</head>
	<body>
		<div id="wrapper">
			<h1>MyAccount</h1>
			
			<div id="nav">
				<ul id="menu">
					<li><a href="items.php">AllProducts</a></li>
					<li><a href="cart.php">MyCart</a></li>
					<li><a href="account.php" class="active">MyAccount</a></li>
				</ul>
			</div>
			
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<table>
					<tr>
						<th colspan="2">Account information:</th>
					</tr>
					<tr valign="top">
						<td align="right">Id:</td>
						<td><?php echo $customer->getId(); ?></td>
					</tr>
					<tr valign="top">
						<td align="right">Fname:</td>
						<td><?php echo $customer->getFname(); ?></td>
					</tr>
					<tr valign="top">
						<td align="right">Lname:</td>
						<td><?php echo $customer->getLname(); ?></td>
					</tr>
					<tr>
						<th colspan="2">Customer information:</th>
					</tr>
					<tr valign="top">
						<td align="right">Email:</td>
						<td><?php echo $customer->getEmail(); ?></td>
					</tr>
					<tr valign="top">
						<td align="right">Pword:</td>
						<td><?php echo $customer->getPword(); ?></td>
					</tr>
				</table>
			</form>
		</div>
	</body>
</html>