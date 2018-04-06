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
		try
		{
			$this->dbh = new PDO("mysql:host={$this->host}; dbname={$this->name}", $this->user, $this->pass, array(
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false
			));
		}
		catch (PDOException $e)
		{
			echo 'Connection failed: ' . $e->getMessage();
		}
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
	
	public static function getCount($sth, $array)
	{
		$sth->execute($array);
		
		return $sth->fetchColumn();
	}
	
	public static function getClass($sth, $array, $class)
	{
		$sth->execute($array);
		
		return $sth->fetchObject($class);
	}
	
	public static function setClass($sth, $array, $dbh)
	{
		$sth->execute($array);
		
		return $dbh->lastInsertId();
	}
	
	public static function getId($sth, $array, $dbh)
	{
		$sth->execute($array);
		
		return $sth->fetch(PDO::FETCH_NUM);
	}
}

$dbh = SPDO::getInstance();

?>