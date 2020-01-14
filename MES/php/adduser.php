<?php
include_once("../classes/user.php");
session_start();


	$account = $_SESSION['account'];
	$module = $_SESSION['module'];
	$employeeCode = $_GET['employeeCode'];
	$username = $_GET['username'];
	$password = $_GET['password'];
	$compass = $_GET['compass'];
	$gender = $_GET['gender'];
	$auth = $_GET['auth'];

	if($password == $compass ){
		$Exist = User::UserExist($username,$password,$account,$module,$employeeCode);

			if($Exist == 'true')
			{
			echo 'adderror6';

			}else{
				
			$User = new User();
			$User->setUsername($username);
			$User->setAccount($account);
			$User->setModule(strtolower($module));
			$User->setPassword($password);
			$User->setEmployeeCode($employeeCode);
			$User->setAuthentication($auth);
			$User->setGender(strtolower($gender));
			$User->addUser();

			echo 'addsuccess1';
			}

		}else{			
			// echo " ".$account." ".$module." ".$employeeCode." ".$username." ".$password." ".$compass." ".$gender." ".$auth; 
			echo 'adderror5';
		}
	

?>