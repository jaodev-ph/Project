<?php
include_once("connection.php");

class User{
	private $username;
	private $password;
	private $authentication;
	private $module;
	private $gender;
	private $account;
	private $employeeCode;
	private $active;
	private $id;

	function __construct(){

	}

	//setter
	public function setUsername($username)
	{
		$this->username = $username;
	}

	public function setID($id) 
	{
		$this->id = $id;

	}


	public function setPassword($password)
	{
		$this->password = $password;
	}

	public function setAuthentication($authentication)
	{
		$this->authentication = $authentication;
	}

	public function setModule($module)
	{
		$this->module = $module;
	}


	public function setGender($gender)
	{
		$this->gender = $gender;
	}

	public function setAccount($account)
	{
		$this->account = $account;
	}

	public function setEmployeeCode($employeeCode)
	{
		$this->employeeCode = $employeeCode;
	}

	public function setActive($active)
	{
		$this->active = $active;
	}


	//Getter

	public function getID()
	{
		return $this->id;
	}
	
	public function getUsername()
	{
		return $this->username;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function getAuthentication()
	{
		return $this->authentication;
	}

	public function getModule()
	{
		return $this->module;
	}

	public function getGender()
	{
		return $this->gender;
	}

	public function getAccount()
	{
		return $this->account;
	}

	public function getEmployeeCode()
	{
		return $this->employeeCode;
	}

	public function getActive()
	{
		return $this->active;
	}



	public static function SelectCurrentUser($account,$module,$employeeCode,$password)
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.users WHERE account ='".$account."' and module ='".$module."' and employeeCode ='".$employeeCode."' and password ='".$password."'");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){
				$Select = new User();
				$Select->setUsername($reader["username"]);
				 $Select->setEmployeeCode($reader["employeeCode"]);
				 $Select->setAuthentication($reader["authentication"]);
				 $Select->setModule($reader["module"]);
				 $Select->setGender($reader["gender"]);
				 $Select->setActive($reader["active"]);
				$result[$counter] = $Select;
				$counter++;
			}

			
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
	}



	public static function validateUser($employeeCode, $password)
	{
		$conn = new connection();
		$result = false;

		try{
			$conn->open();
			$myquery = $conn->query("SELECT * FROM dbo.users WHERE employeeCode = '".$employeeCode."' and password = '".$password."'");

			if ($conn->has_rows($myquery)>0){
				$result = true;
			}
			
			$conn->close();
			}
		catch(Exception $e){

		}
		return $result;
	}



	public static function validateAccount($employeeCode, $password, $account, $module)
	{
		$conn = new connection();
		$result = '';

		try{
			$conn->open();
			
		     $myquery = $conn->query("SELECT * FROM dbo.users WHERE employeeCode = '".$employeeCode."' and password = '".$password."' and account ='".$account."' and module = '".trim($module)."' ");	
		     

			if ($conn->has_rows($myquery)>0){

				$dataresult = $conn->fetch_array($myquery);				
				$result = $dataresult['account'];
			
				
			}
			
			$conn->close();
			}
		catch(Exception $e){

		}
		return $result;
	}


	public static function getAuth($employeeCode, $password, $account, $module,$auth)
	{
		$conn = new connection();
		$result = '';

		try{
			$conn->open();
			if($auth == true){
			$myquery = $conn->query("SELECT * FROM dbo.users WHERE employeeCode = '".$employeeCode."' and password = '".$password."'");			
		     }else{
			$myquery = $conn->query("SELECT * FROM dbo.users WHERE employeeCode = '".$employeeCode."' and password = '".$password."' and account ='".$account."' and module = '".trim($module)."'");
			}

			if ($conn->has_rows($myquery)>0){
			    $reader = $conn->fetch_array($myquery);
			    $result = $reader['authentication'];
			}
			
			$conn->close();
			}
		catch(Exception $e){

		}
		return $result;
	}


	public function userDetails($admin)
	{
		$conn = new connection();

		try{
			$conn->open();
			if($admin == false){

			$myquery = $conn->query("SELECT * FROM dbo.users WHERE employeeCode = '".$this->getEmployeeCode()."' and password = '".$this->getPassword()."' and account ='".$this->getAccount()."' and module ='".trim($this->getModule())."'");
			}else{
				
			$myquery = $conn->query("SELECT * FROM dbo.users WHERE employeeCode = '".$this->getEmployeeCode()."' and password = '".$this->getPassword()."'");
			}

			if ($conn->has_rows($myquery)>0){
			    $reader = $conn->fetch_array($myquery);
			   
			    $this->setGender($reader['gender']);
			    $this->setModule($reader['module']);
			    $this->setPassword($reader['password']);
			    $this->setEmployeeCode($reader['employeeCode']);
			    $this->setUsername($reader['username']);
			}
			
			$conn->close();
			}
		catch(Exception $e){

		}
		
	}

		public static function userModule($employeeCode, $password, $account, $module)
	{
		$conn = new connection();
		$result ='';
		try{
			$conn->open();
			$myquery = $conn->query("SELECT * FROM dbo.users WHERE employeeCode = '".$employeeCode."' and password = '".$password."' and account ='".$account."' and module = '".trim($module)."'");

			if ($conn->has_rows($myquery)>0){
				$dataresult = $conn->fetch_array($myquery);								
				$result = $dataresult['module'];
				
			}
			
			$conn->close();

			}catch(Exception $e){

		}

		return $result;
	
	}

	public function changePass($newpass){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("UPDATE dbo.users SET password ='".$newpass."' WHERE account ='".$this->getAccount()."' AND module ='".$this->getModule()."' AND username ='".$this->getUsername()."' AND password ='".$this->getPassword()."'");
			$conn->close();
		}catch(Exception $e){

		}
	}


	public function addUser(){
		$conn = new Connection();

		try{
			$conn->open();
			$conn->query("INSERT INTO dbo.users VALUES('".$this->getAccount()."','".$this->getUsername()."','".$this->getPassword()."','".$this->getEmployeeCode()."',GETDATE(),'".$this->getAuthentication()."','1','".$this->getModule()."','".$this->getGender()."')");
			$conn->close();
		}catch(Exception $e){

		}
	}


	public static function UserExist($username, $password, $account, $module,$employeeCode)
	{
		$conn = new connection();
		$result = 'false';

		try{
			$conn->open();
			$myquery = $conn->query("SELECT * FROM dbo.users WHERE employeeCode ='".$employeeCode."' and account ='".$account."' and module ='".$module."'");

			if ($conn->has_rows($myquery)>0){
				$result = 'true';
			}else{
				$result = 'false';
			}
			
			$conn->close();
			}
		catch(Exception $e){

		}
		return $result;
	}


	public static function SelectAllUser($account,$module)
	{
		$conn = new connection();
		$result = array();

		try{
			$conn->open();
			$dataset =  $conn->query("SELECT * FROM dbo.users WHERE account ='".$account."' and module ='".strtolower($module)."' order by username");
			$counter = 0;
			while($reader = $conn->fetch_array($dataset)){
				$Select = new User();
				$Select->setUsername($reader["username"]);
				 $Select->setEmployeeCode($reader["employeeCode"]);
				 $Select->setAuthentication($reader["authentication"]);
				 $Select->setModule($reader["module"]);
				 $Select->setGender($reader["gender"]);
				 $Select->setActive($reader["active"]);
				$result[$counter] = $Select;
				$counter++;
			}

			
			$conn->close();
			
		}catch(Exception $e){

		}
		return $result;
	}





	public function userInfo()
	{
		$conn = new connection();

		try{
			$conn->open();
			$myquery = $conn->query("SELECT * FROM dbo.users WHERE employeeCode = '".$this->getEmployeeCode()."'and account ='".$this->getAccount()."' and module ='".trim($this->getModule())."'");
			
			if ($conn->has_rows($myquery)>0){
			    $reader = $conn->fetch_array($myquery);
			   
			    $this->setGender($reader['gender']);
			    $this->setModule($reader['module']);
			    $this->setPassword($reader['password']);
			    $this->setEmployeeCode($reader['employeeCode']);
			    $this->setUsername($reader['username']);
			    $this->setAuthentication($reader['authentication']);

			}
			
			$conn->close();
			}
		catch(Exception $e){

		}
		
	}




	public function userEdit()
	{
		$conn = new connection();

		try{
			$conn->open();
			$myquery = $conn->query("UPDATE dbo.users SET username ='".$this->getUsername()."',password ='".$this->getPassword()."',authentication ='".$this->getAuthentication()."',gender ='".$this->getGender()."' WHERE employeeCode = '".$this->getEmployeeCode()."'and account ='".$this->getAccount()."' and module ='".trim($this->getModule())."'");
			
			$conn->close();
			}
		catch(Exception $e){

		}
		
	}



}

?>