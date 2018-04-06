<?php

class Account
{
	private $id, $email, $pword;
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getEmail()
	{
		return $this->email;
	}
	
	public function getPword()
	{
		return $this->pword;
	}
	
	public static function isExist($array)
	{
		try
		{
			return (SPDO::getCount(SPDO::getInstance()->prepare('SELECT COUNT(*) FROM account WHERE email=:email'), $array) > 0) ? true : false;
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public static function getAccount($array)
	{
		try
		{
			return SPDO::getClass(SPDO::getInstance()->prepare('SELECT * FROM account WHERE email=:email AND pword=:pword'), $array, 'Account');
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public static function getAccountById($array)
	{
		try
		{
			return SPDO::getClass(SPDO::getInstance()->prepare('SELECT * FROM account WHERE customer_id=:id'), $array, 'Account');
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public static function setAccount($array, $dbh)
	{			
		try
		{
			return SPDO::setClass($dbh->prepare('INSERT INTO account (email, pword, customer_id) VALUES (:email, :pword, :customer_id)'), $array, $dbh);
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public static function getCustomerId($array, $dbh)
	{
		try
		{
			return SPDO::getId($dbh->prepare('SELECT id FROM account WHERE email=:email AND pword=:pword'), $array, $dbh);;
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
		}
	}
}

class Customer
{
	private $id, $fname, $lname;
	
	private $account;
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getFname()
	{
		return $this->fname;
	}
	
	public function getLname()
	{
		return $this->lname;
	}
	
	public function getEmail()
	{
		return $this->account->getEmail();
	}
	
	public function getPword()
	{
		return $this->account->getPword();
	}
	
	public function setAccount($account)
	{
		$this->account = $account;
	}
	
	public static function getCustomer($array)
	{
		try
		{
			return SPDO::getClass(SPDO::getInstance()->prepare('SELECT * FROM customer WHERE id=:id'), $array, 'Customer');
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public static function setCustomer($array, $dbh)
	{	
		try
		{
			return SPDO::setClass($dbh->prepare('INSERT INTO customer (fname, lname) VALUES (:fname, :lname)'), $array, $dbh);
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
		}
	}
}

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

?>