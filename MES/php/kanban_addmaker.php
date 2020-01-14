<?php
include_once("../classes/kanban_makerlist.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$maker = $_GET['Maker'];
	
	$exist = Makerlist::checkifexist($account, $maker);

	if ($exist == 'false') {
		$Makerlist = new Makerlist();
		$Makerlist->setAccount($account);
		$Makerlist->setMaker($maker);
		$Makerlist->setLastupdatedby($name);
		$Makerlist->addMaker();

		echo "ok";
	} else {
		echo "notok";
	}
			
	
?>