<?php

class Item
{
	private $id, $iname, $rdate;
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getIname()
	{
		return $this->iname;
	}
	
	public function getRdate()
	{
		return $this->rdate;
	}	
}

require_once 'db-init.php';

session_start();

if(isset($_SESSION['cart']))
{
	if(isset($_POST['del']))
	{
		unset($_SESSION['cart'][$_POST['del']]);
		$_SESSION["cart"] = array_values($_SESSION["cart"]);
	}
	if(isset($_POST['empty']))
	{
		unset($_SESSION['cart']);
		$_SESSION['cart'] = null;
	}
}

if (!isset($_SESSION['cart']))
{
	$_SESSION['cart'] = array();
}

?>

<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="styles.css"> 
	</head>
	<body>
		<div id="wrapper">
			<h1>MyCart</h1>
			
			<div id="nav">
				<ul id="menu">
					<li><a href="items.php">AllProducts</a></li>
					<li><a href="cart.php" class="active">MyCart</a></li>
					<li><a href="account.php">MyAccount</a></li>
				</ul>
			</div>
			
			<table>
				<tr>
					<th>Nro</th><th>Pname</th><th>Rdate</th><th>Operation</th>
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
						</form>
					</td>
				</tr>
			</table>
		</div>
	</body>
</html>