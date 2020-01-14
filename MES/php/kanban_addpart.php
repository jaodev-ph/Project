<?php
include_once("../classes/kanban_partslist.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$partno = $_GET['Partno'];
	$maker = $_GET['Maker'];
	$description = $_GET['Description'];
	$compotype = $_GET['Compotype'];
	

	$exist = Partslist::checkifexist($account, $partno);	

		if ($exist == 'false') {
				$Partslist = new Partslist();
				$Partslist->setAccount($account);
				$Partslist->setPartNo($partno);
				$Partslist->setMaker($maker);
				$Partslist->setDescription($description);
				$Partslist->setCompoType($compotype);
				$Partslist->addPart();

				echo 'ok';
			} else {
				echo 'notok';
			}	
			
	
?>