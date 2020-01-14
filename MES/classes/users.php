<?php

include_once("connection2.php");

class Users{
	private $username;
	private $password;
	private $department;
	private $section;
	private $active;
	private $name;
	private $canstopline;
	private $defaulFactoryId;
	private $path;

	function __construct($username = ''){
		
		if(strlen($username)!=0){


				$conn = new Connection1();

				try{
					$conn->open();
					$dataset=$conn->query("SELECT * FROM dbo.users a inner join dbo.FactoryWorker b on a.username = b.id WHERE username = '".$username."'");

					if($conn->has_rows($dataset)){
						$reader = $conn->fetch_array($dataset);

						$this->setUsername($reader['username']);
						$this->setPassword($reader['password']);
						$this->setSection($reader['section']);
						$this->setDepartment($reader['dept']);		
						$this->setActive($reader['active']);
						$this->setFullName($reader['name']);
						$this->setPath($reader['image']);

					}
					$conn->close();
				}catch(Exception $e){

				}
		}

	}

	//Setter
	public function setUsername($username){
		$this->username = $username;
	}

	public function setPassword($password)
	{
		$this->password = $password;
	}

	public function setDepartment($department){
		$this->department = $department;
	}
	
	public function setActive($active){
		$this->active = $active;
	}

	public function setSection($section){
		$this->section = $section;
	}

	public function setFullName($name){
		$this->name = $name;
	}

	public function setCanStopLine($canstopline){
		$this->canstopline = $canstopline;
	}

	public function setDefaultFactoryId($defaulFactoryId){
		$this->defaulFactoryId = $defaulFactoryId;
	}

	public function setPath($path){
		$this->path = $path;
	}

	//Getter
	public function getUsername(){
		return $this->username;
	}

	public function getPassword(){
		return $this->password;
	}

	public function getDepartment(){
		return $this->department;
	}

	public function getSection(){
		return $this->section;
	}
	
	public function getActive(){
		return $this->active;
	}

	public function getFullName(){
		return $this->name;
	}

	public function getCanStopLine(){
		return $this->canstopline;
	}

	public function getDefaultFactoryId(){
		return $this->defaulFactoryId;
	}

	public function getPath(){
		return $this->path;
	}
	
	public static function getAllUsers(){
		$conn = new Connection1();
		$users = array();

		try{
			$conn->open();
			$result = $conn->query("SELECT * FROM dbo.users ORDER BY username asc");
			$counter = 0;
			while($row = $conn->fetch_array($result))
			{
				$user = new Users();
				$user->setUsername($row['username']);
				$user->setSection($row['section']);
				$user->setDepartment($row['dept']);
				$user->setActive($row['active']);
				$users[$counter]=$user;
				$counter++;
			}
			$conn->close();
		}catch(Exception $e){
			
		}

		return $users;

	}

		public function update(){
			$conn = new Connection1();

		try{
			$conn->open();
			$dataset = $conn->query("UPDATE dbo.users SET 
									password = '".$this->getPassword()."', 
									dept = '".$this->getDepartment()."',
									section = '".$this->getSection()."',
									active = '".$this->getActive()."'
									WHERE username = '".$this->getUsername()."'");
			$conn->close();
		}catch(Exception $e){
			$success = false;
		}
		return $dataset;
	}

	public function update1($gender,$fullname){
			$conn = new Connection1();

		try{
			$conn->open();
			$dataset = $conn->query("UPDATE dbo.FactoryWorker SET 
									name = '".$this->getFullName()."', 
									role = '".$this->getSection()."',
									image = '".$gender."'
									WHERE id = '".$this->getUsername()."'");
			$conn->close();
		}catch(Exception $e){
			$success = false;
		}
		return $dataset;
	}


	public function add()
	{
		$success = true;
		$conn = new Connection1();

		try{
			$conn->open();
			$conn->query("INSERT INTO dbo.users VALUES( 
								'".$this->getUsername()."',
								'".$this->getPassword()."',
								'',
								'".$this->getDepartment()."',
								'".$this->getSection()."',
								'Offline',
								'".$this->getActive()."')");

			$conn->close();
		}
		catch(Exception $e){
			$success = false;
		}

		return $success;
	}

	public function add1()
	{
		$success = true;
		$conn = new Connection1();

		try{
			$conn->open();
				$conn->query("INSERT INTO dbo.FactoryWorker VALUES(
								'0',
								'".$this->getUsername()."',
								'".$this->getFullName()."',
								'".$this->getSection()."',
								'F1',
								'".$this->getPath()."')");
			$conn->close();
		}
		catch(Exception $e){
			$success = false;
		}

		return $success;
	}

	public function delete(){
		$success = true;
		$conn = new Connection1();

		try{
			$conn->open();
			$conn->query("DELETE FROM dbo.users WHERE username = '".$this->getUsername()."'");
			$conn->close();
		}
		catch(Exception $e){

		}

		return $success;
	}

	
	public static function checkExist($username){
		$conn = new Connection1();
		$result = false;

		try{
			$conn->open();
			$dataset = $conn->query("SELECT username FROM dbo.users WHERE username = '".$username."', password = '".$password."', dept = '".$department."', section = '".$section."'");

			if($conn->has_rows($dataset)){
				$result = true;
			}else{
				$result = false;
			}
			$conn->close();
		}catch(Exception $e){

		}
		return $result;
	}

}


?>