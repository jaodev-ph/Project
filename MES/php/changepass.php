<?php
include_once("../classes/user.php");
session_start();

	$txtuser = $_SESSION['name'];
	$account = $_SESSION['account'];
	$current = $_SESSION['password'];
	$module = $_SESSION['module'];
	$oldpass = $_GET['oldpass'];
	$newpass = $_GET['newpass'];
	$compass = $_GET['compass'];

	
	if($current == $oldpass)
	{
		if($newpass == $compass ){

			$User = new User();
			$User->setUsername($txtuser);
			$User->setAccount($account);
			$User->setModule(strtolower($module));
			$User->setPassword($current);
			$User->changePass($newpass);

			echo 'success1';

		}else{			
			echo 'error5';
		}
	}else{
		// echo  $txtuser." ".$account." " .$module." ".$newpass." ".$newpass;
		echo 'error4';
		
	}

?>