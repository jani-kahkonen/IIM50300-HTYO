<?php

class SPDO
{
	private static $instance = null;
	private $dbh;
	
	private $host = 'mysql.labranet.jamk.fi';
	private $name = 'H9575';
	private $user = 'H9575';
	private $pass = '7ahaqDkFKfb2Oljcrm4J9avJBY0b5SR8';
	
	private function __construct()
	{
		$this->dbh = new PDO("mysql:host={$this->host}; dbname={$this->name}", $this->user, $this->pass, array(
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false
		));
	}
	
	public static function getInstance()
	{
		return (self::$instance) ? self::$instance : new SPDO();
	}
	
	public function getConnection()
	{
		return $this->dbh;
	}
	
	public function prepare($query)
	{
		return $this->dbh->prepare($query);
	}
	
	public function lastInsertId()
	{
		return $this->dbh->lastInsertId();
	}
}

$dbh = SPDO::getInstance();

// Select account id by email and pword.
//$sth = $dbh->prepare('SELECT id FROM account WHERE email = :email AND pword = :pword');
//$sth->execute(array(':email' => $email, ':pword' => $pword));
//$rows = $sth->fetchAll(PDO::FETCH_NUM);
		
//echo $rows[0][0];

// Insert account.
//$sth = $dbh->prepare('INSERT INTO account (email, pword, fname, lname) VALUES (:email, :pword, :fname, :lname)');
//$sth->execute(array(':email' => $email, ':pword' => $pword, ':fname' => $fname, ':lname' => $lname));
//$insertId = $dbh->lastInsertId();

//echo $insertId[0][0];

//SELECT COUNT(*) FROM account WHERE email = :email AND pword = :pword

//SELECT COUNT(*) FROM account WHERE email = :email AND pword = :pword
//$nume = $dbo->query("select count(*) from  pdo_admin")->fetchColumn();

?>