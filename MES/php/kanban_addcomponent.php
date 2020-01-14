<?php
include_once("../classes/kanban_componentlist.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$componentcode = $_GET['ComponentCode'];
	$description = $_GET['Description'];
	
	$exist = Componentlist::checkifexist($account, $componentcode, $description);


	if ($exist == 'false') {
		$componentlist = new Componentlist;
		$componentlist->setAccount($account);
		$componentlist->setComponentCode($componentcode);
		$componentlist->setDescription($description);
		$componentlist->setLastUpdatedBy($name);
		$componentlist->addComponent();
		echo 'ok';
	} else {
		echo "notok";
	}
				
			

		
	
?>