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
	// Set item to cart.
	if(isset($_POST['add']))
	{
		$sth = $dbh->prepare('SELECT * FROM product WHERE id=:id');
		$sth->execute(array(':id' => $_POST['add']));
		array_push($_SESSION['cart'], $sth->fetchObject("Item"));
	}
}

if (!isset($_SESSION['cart']))
{
	$_SESSION['cart'] = array();
}

$sth = $dbh->prepare('SELECT * FROM product');
$sth->execute();

?>

<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../styles/styles.css"> 
	</head>
	<body>
		<div id="wrapper">
			<h1>AllProducts</h1>
			
			<div id="nav">
				<ul id="menu">
					<li><a href="items.php" class="active">AllProducts</a></li>
					<li><a href="cart.php">MyCart</a></li>
					<li><a href="account.php">MyAccount</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</div>
			
			<table>
				<tr>
					<th>Nro</th><th>Pname</th><th>Rdate</th><th>Operation</th>
				</tr>
							
				<?php for($num = 0; $row = $sth->fetchObject("Item"); ++$num){ ?>
				<tr>
					<td><?php echo $num; ?></td>
					<td><?php echo $row->getIname(); ?></td>
					<td><?php echo $row->getRdate(); ?></td>
					<td>
						<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
							<input type="hidden" name="add" value="<?php echo htmlspecialchars($row->getId()); ?>"></input>
							<input type="submit" value="Add"></input>
						</form>
					</td>
				</tr>
				<?php } ?>
				
				<tr>
					<td colspan="4"><a>Tuotteita yhteensä:</a><a><?php echo $sth->rowCount(); ?></a></td>
				</tr>
			</table>
		</div>
	</body>
</html>