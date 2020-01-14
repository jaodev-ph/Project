<?php
include_once("../classes/user.php");
session_start();


	$account = $_SESSION['account'];
	$module = $_SESSION['module'];
	$employeeCode = $_GET['employeeCode'];
	$username = "";
	$password =  "";
	

	
		$Exist = User::UserExist($username,$password,$account,$module,$employeeCode);

			if($Exist == 'true')
			{
			$User = new User();
			$User->setAccount($account);
			$User->setModule(strtolower($module));
			$User->setEmployeeCode($employeeCode);
			$User->userInfo();
			$User->getGender();
			$User->getModule();
			$User->getEmployeeCode();
			$User->getUsername();
			$User->getAuthentication();

			echo ucfirst($User->getGender()).",".strtoupper($User->getModule()).",".$User->getEmployeeCode().",".$User->getUsername().",".$User->getAuthentication().",".$User->getPassword();

			}else{				
			echo 'editerror1';
			}


?>