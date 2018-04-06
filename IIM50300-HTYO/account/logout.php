<?php

session_start();

unset($_SESSION["cart"]);
unset($_SESSION["customerId"]);

if(!isset($_SESSION['customerId']) and !isset($_SESSION['cart']))
{
	// If not customerId, redirect to login and exit.
	header("Location: ../login.php") and exit();
}

?>