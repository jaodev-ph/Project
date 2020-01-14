<?php

include_once("../classes/its_workstation.php");
session_start();

$mode =1;

		$itsget = new Its_workstation();
		$itsget->getuserByID($_GET['id']);
		echo $itsget->getUsername()."_".$itsget->getCompany()."_".$itsget->getDepartment()."_".$itsget->getID();
?>