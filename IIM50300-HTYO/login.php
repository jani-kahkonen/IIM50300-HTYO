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
						<td><input type="text" name="email" value="test@outlook.com" required></td>
					</tr>
					<tr valign="top">
						<td align="right">Pword:</td>
						<td><input type="password" name="pword" value="test" required></td>
					</tr>
					<tr valign="top">
						<td align="right"></td>
						<td><input type="submit" name="login" value="Login"></td>
					</tr>
					<tr valign="top">
						<td align="right"></td>
						<td><span class="error"><?php if(isset($_GET['loginError'])) echo $_GET['loginError']; ?></span></td>
					</tr>
				</table>
			</form>
		</div>
	</body>
</html>