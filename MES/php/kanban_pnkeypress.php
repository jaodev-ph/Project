<?php
include_once("../classes/kanban_partslist.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$partno = $_GET['Partno'];
	$description = $_GET['Description'];
	$maker = $_GET['Maker'];
	$compotype = $_GET['Compotype'];

	$exist = Partslist::checkifexist($account, $partno);
		if ($exist == 'true') {
			$Partslist = new Partslist();
			$Partslist->setPartno($partno);
			$Partslist->setDescription($description);
			$Partslist->setMaker($maker);
			$Partslist->setCompotype($compotype);
			$Partslist->pnInfo();

		echo 'ok_'.$Partslist->getPartno()."_".$Partslist->getDescription()."_".$Partslist->getMaker()."_".$Partslist->getCompotype();
		} else {
			echo 'notexist_'.$partno;
		}
			
			
?>