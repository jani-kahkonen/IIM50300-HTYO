<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="styles/styles.css">
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
						<td><input type="text" name="fname" value="<?php if(isset($_GET['fname'])) echo $_GET['fname']; ?>"><span class="error"><?php if(isset($_GET['fnameError'])) echo $_GET['fnameError']; ?></span></td>
					</tr>
					<tr valign="top">
						<td align="right">Lname:</td>
						<td><input type="text" name="lname" value="<?php if(isset($_GET['lname'])) echo $_GET['lname']; ?>"><span class="error"><?php if(isset($_GET['lnameError'])) echo $_GET['lnameError']; ?></span></td>
					</tr>
					<tr valign="top">
						<td align="right">Email:</td>
						<td><input type="text" name="email" value="<?php if(isset($_GET['email'])) echo $_GET['email']; ?>"><span class="error"><?php if(isset($_GET['emailError'])) echo $_GET['emailError']; ?></span></td>
					</tr>
					<tr valign="top">
						<td align="right">Pword:</td>
						<td><input type="password" name="pword"><span class="error"><?php if(isset($_GET['pwordError'])) echo $_GET['pwordError']; ?></span></td>
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