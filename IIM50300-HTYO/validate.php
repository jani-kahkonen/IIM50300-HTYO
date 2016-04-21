<?php

require_once 'db-init.php';

session_start();

function find($sql, $param, $dbh)
{
	$sth = $dbh->prepare($sql);
	$sth->execute($param);
	return $sth->fetchAll(PDO::FETCH_NUM);
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	if(isset($_POST['login']))
	{
		$customerId = find('SELECT id FROM account WHERE email=:email AND pword=:pword', array(':email' => $_POST['email'], ':pword' => $_POST['pword']), $dbh);
		
		$_SESSION['customerId'] = $customerId[0][0];
		
		if($customerId[0][0] > 0)
		{
			header("Location: http://student.labranet.jamk.fi/~H9575/IIM50300-HTYO/items.php");
			die();
		}
		else
		{
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}
	
	if(isset($_POST['register']))
	{
		$customerId = find('SELECT id FROM account WHERE email=:email', array(':email' => $_POST['email']), $dbh);
		
		if($customerId[0][0] > 0)
		{
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
		else
		{
			$sth = $dbh->prepare('INSERT INTO customer (fname, lname) VALUES (:fname, :lname)');
			$sth->execute(array(':fname' => $_POST['fname'], ':lname' => $_POST['lname']));
			$insertId = $dbh->lastInsertId();
			
			$sth = $dbh->prepare('INSERT INTO account (email, pword, customer_id) VALUES (:email, :pword, :customer_id)');
			$sth->execute(array(':email' => $_POST['email'], ':pword' => $_POST['pword'],':customer_id' => $insertId));
			
			$_SESSION['customerId'] = $insertId;
				
			header("Location: http://student.labranet.jamk.fi/~H9575/IIM50300-HTYO/items.php");
			die();
		}
	}
}

// http://stackoverflow.com/questions/14523468/redirecting-to-previous-page-after-login-php

?>