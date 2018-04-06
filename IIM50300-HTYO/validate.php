<?php

require_once 'database/db-init.php';
require_once 'class/class.php';

session_start();

function testInput($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	return htmlspecialchars($data);
}

function checkLogData($email, $pword)
{
	// Default redirect.
	$redirect = 'login.php?';
	
	// Check email.
	if (empty($email))
	{
		$redirect .= '&emailError=Required';
	}
	
	// Check pword.
	if (empty($pword))
	{
		$redirect .= '&pwordError=Required';
	}
	
	return $redirect;
}

function checkRegData($fname, $lname, $email, $pword)
{
	// Default redirect.
	$redirect = 'register.php?';
	
	// Check fname.
	if (empty($fname))
	{
		$redirect .= '&fnameError=Required';
	}
	else
	{	
		if (!preg_match("/^[a-zA-Z ]*$/", testInput($fname)))
		{
			$redirect .= '&fnameError=Only letters';
		}
	}
	
	// Check lname.
	if (empty($lname))
	{
		$redirect .= '&lnameError=Required';
	}
	else
	{	
		if (!preg_match("/^[a-zA-Z ]*$/", testInput($lname)))
		{
			$redirect .= '&lnameError=Only letters';
		}
	}
	
	// Check email.
	if (empty($email))
	{
		$redirect .= '&emailError=Required';
	}
	else
	{		
		if (!filter_var(testInput($email), FILTER_VALIDATE_EMAIL))
		{
			$redirect .= '&emailError=Invalid format';
		}
	}
	
	// Check pword.
	if (empty($pword))
	{
		$redirect .= '&pwordError=Required';
	}
	
	return $redirect . "&fname=" . testInput($fname) . "&lname=" . testInput($lname) . "&email=" . testInput($email);
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	// Default redirect.
	$redirect = null;
	
	// If login.
	if(isset($_POST['login']))
	{
		$redirect = checkLogData($_POST['email'], $_POST['pword']);
		
		if($redirect == 'login.php?')
		{
			if(Account::isExist(array(':email' => $_POST['email'])))
			{
				// Get Account id and return customer id.
				$customerId = Account::getCustomerId(array(':email' => $_POST['email'], ':pword' => $_POST['pword']), $dbh);
				
				if($customerId)
				{
					$_SESSION['customerId'] = $customerId[0];
					
					// Set redirect.
					$redirect = 'account/items.php';
				}
				else
				{
					$redirect = 'login.php?loginError=Incorrect email or pword';
				}
			}
			else
			{
				$redirect = 'login.php?loginError=Incorrect email';
			}	
		}
	}
	
	// If register.
	if(isset($_POST['register']))
	{
		$redirect = checkRegData($_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['pword']);
		
		if($redirect == 'register.php?' . "&fname=" . $_POST['fname'] . "&lname=" . $_POST['lname'] . "&email=" . $_POST['email'])
		{
			if(Account::isExist(array(':email' => $_POST['email'])))
			{
				$redirect .= '&emailError=Account already exist';
			}
			else
			{
				// Set customer and get customer id.
				$_SESSION['customerId'] = Customer::setCustomer(array(':fname' => $_POST['fname'], ':lname' => $_POST['lname']), SPDO::getInstance());
				
				// Set customer id to account.
				Account::setAccount(array(':email' => $_POST['email'], ':pword' => $_POST['pword'], ':customer_id' => $_SESSION['customerId']), SPDO::getInstance());
				
				// Set redirect.
				$redirect = 'account/items.php';
			}
		}
	}
	
	// Redirect.
	header("Location: " . $redirect) and exit();
}

?>