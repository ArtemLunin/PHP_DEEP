<?php
namespace App\User;
class User
{
	private $name;
	private $email;
	private $pass;
	private $age;

	public function __construct($name =null, $email =null, $pass =null, $age =null) {
		$this->name = $name;
		$this->email = $email;
		$this->pass = $pass;
		$this->age = $age;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function getPass()
	{
		return $this->pass;
	}

	public function setPass($Pass)
	{
		$this->pass = $pass;
	}

	public function getAge()
	{
		return $this->age;
	}

	public function setAge($age)
	{
		$this->age = $age;
	}

}