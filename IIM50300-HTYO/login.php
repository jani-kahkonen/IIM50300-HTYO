<!DOCTYPE html>

<?php

echo '<input type="hidden" name="location" value="';

if(isset($_GET['location']))
{
	echo htmlspecialchars($_GET['location']);
}

echo '" />';

//  <input type="hidden" name="location" value="comment.php?articleid=17" />

?>

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
		</style>
	</head>
	<body>
		<div id="wrapper">
			<h1>Login</h1>
			
			<div id="nav">
				<ul id="menu">
					<li><a href="login.php" class="active">Login</a></li>
					<li><a href="register.php">Register</a></li>
				</ul>
			</div>
			
			<form action="validate.php" method="post">
				<table>
					<tr valign="top">
						<td align="right">Email:</td>
						<td><input type="text" name="email" required></td>
					</tr>
					<tr valign="top">
						<td align="right">Pword:</td>
						<td><input type="text" name="pword" required></td>
					</tr>
					<tr valign="top">
						<td align="right"></td>
						<td><input type="submit" name="login" value="Login"></td>
					</tr>
				</table>
			</form>
		</div>
	</body>
</html>