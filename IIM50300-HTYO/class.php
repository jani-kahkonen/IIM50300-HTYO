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
}

?>