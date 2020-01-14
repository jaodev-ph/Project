<?php
include_once("../classes/kanban_partsrecords.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];

	

	$did =  $_GET['DID'];


	$exist = Partsrecords::didCheck($account, strtoupper($did));

	if ($exist == 'true') {

			$Partsrecords = new Partsrecords();

			$Partsrecords->didInfo($did);
		echo 'ok_'.$Partsrecords->getPartno()."_".$Partsrecords->getIPN()."_".$Partsrecords->getDescription()."_".$Partsrecords->getMaker()."_".$Partsrecords->getMakercode()."_".$Partsrecords->getLotno()."_".$Partsrecords->getCompotype()."_".$Partsrecords->getQty()."_".$Partsrecords->getStatus()."_".$Partsrecords->getPrintedby()."_".$Partsrecords->getInvoiceno()."_".$Partsrecords->getLine();
		
	} else {
		echo "notok";
	}


			
	
?>