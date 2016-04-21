<?php

$fname = "";
$lname = "";
$email = "";
$pword = "";

$fnameErr = "";
$lnameErr = "";
$emailErr = "";
$pwordErr = "";

function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	return htmlspecialchars($data);
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	if (empty($_POST["fname"]))
	{
		$fnameErr = "Required";
	}
	else
	{		
		if (!preg_match("/^[a-zA-Z ]*$/", test_input($_POST["fname"])))
		{
			$fnameErr = "Only letters";
		}
	}
	
	if (empty($_POST["lname"]))
	{
		$lnameErr = "Required";
	}
	else
	{	
		if (!preg_match("/^[a-zA-Z ]*$/", test_input($_POST["lname"])))
		{
			$lnameErr = "Only letters";
		}
	}
	
	if (empty($_POST["email"]))
	{
		$emailErr = "Required";
	}
	else
	{		
		if (!filter_var(test_input($_POST["email"]), FILTER_VALIDATE_EMAIL))
		{
			$emailErr = "Invalid format";
		}
	}
	
	if (empty($_POST["pword"]))
	{
		$pwordErr = "Required";
	}
}

?>

<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="styles.css">
		<style>
		#wrapper{
			width: 40%;
		}
		#nav li{
			width: 50%;
		}
		td{
			width: 50%;
		}
		input{
			width: 150px;
		}
		.error{
			color: #FF0000;
		}
		</style>
	</head>
	<body>
		<div id="wrapper">
			<h1>Register</h1>
			
			<div id="nav">
				<ul id="menu">
					<li><a href="login.php">Login</a></li>
					<li><a href="register.php" class="active">Register</a></li>
				</ul>
			</div>
			
			<form action="validate.php" method="post">
				<table>
					<tr valign="top">
						<td align="right">Fname:</td>
						<td><input type="text" name="fname"><span class="error"><?php echo $fnameErr; ?></span></td>
					</tr>
					<tr valign="top">
						<td align="right">Lname:</td>
						<td><input type="text" name="lname"><span class="error"><?php echo $lnameErr; ?></span></td>
					</tr>
					<tr valign="top">
						<td align="right">Email:</td>
						<td><input type="text" name="email"><span class="error"><?php echo $emailErr; ?></span></td>
					</tr>
					<tr valign="top">
						<td align="right">Pword:</td>
						<td><input type="text" name="pword"><span class="error"><?php echo $pwordErr; ?></span></td>
					</tr>
					<tr valign="top">
						<td align="right"></td>
						<td><input type="submit" name="register" value="Register"></td>
					</tr>
				</table>
			</form>
		</div>
	</body>
</html>