<?php
include_once("../classes/user.php");
session_start();


	$account = $_SESSION['account'];
	$oldmodule = $_SESSION['module'];
	$employeeCode = $_GET['employeeCode'];
	$user = $_GET['user'];
	$compass = $_GET['compass'];
	$newpass = $_GET['newpass'];
	$newmodule = $_GET['newmodule'];
	$gender = $_GET['gender'];
	$auth = $_GET['auth'];
	
	
	if($compass == $newpass){

			$User = new User();
			$User->setAccount($account);
			$User->setUsername($user);
			$User->setModule(strtolower($newmodule));
			$User->setPassword($newpass);
			$User->setEmployeeCode($employeeCode);
			$User->setGender($gender);
			$User->setModule($newmodule);
			$User->setAuthentication($auth);
			$User->userEdit();
			echo 'editsuccess1';

		}else{

			echo 'editerror3';
		}

?>