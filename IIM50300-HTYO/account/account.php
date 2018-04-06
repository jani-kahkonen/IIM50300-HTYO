<?php

require_once '../database/db-init.php';
require_once '../class/class.php';

session_start();

if(!isset($_SESSION['customerId']))
{
	// If not customerId, redirect to login and exit.
	header("Location: ../login.php") and exit();
}

// Get account and customer data.
$customer = Customer::getCustomer(array(':id' => $_SESSION['customerId']));
$customer->setAccount(Account::getAccountById(array(':id' => $_SESSION['customerId'])));

?>

<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../styles/styles.css"> 
	</head>
	<body>
		<div id="wrapper">
			<h1>MyAccount</h1>
			
			<div id="nav">
				<ul id="menu">
					<li><a href="items.php">AllProducts</a></li>
					<li><a href="cart.php">MyCart</a></li>
					<li><a href="account.php" class="active">MyAccount</a></li>
					<li><a href="logout.php">Logout</a></li>
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
						<td align="right">Email:</td>
						<td><?php echo $customer->getEmail(); ?></td>
					</tr>
					<tr valign="top">
						<td align="right">Pword:</td>
						<td><?php echo $customer->getPword(); ?></td>
					</tr>
					<tr>
						<th colspan="2">Customer information:</th>
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
				</table>
			</form>
		</div>
	</body>
</html>