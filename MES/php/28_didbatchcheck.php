<?php

include_once("../classes/kanban_partsrecords.php");
session_start();

$account = trim($_SESSION['account']);
$name = $_SESSION['name'];
$did = $_GET['did'];

$exist = Partsrecords::didCheck($account,$did);
$pdn  = Partsrecords::checkPart($account,$did);

if ($exist == 'true'){

	if ($pdn == 'true'){

			echo 'success_';

	}else{

		echo 'didnotissued';
	}

}else{
 
 echo 'notexist_';

}



?>