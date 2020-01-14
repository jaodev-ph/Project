<?php
include_once("../classes/kanban_partsrecords.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$did = $_GET['DID'];
	// $partno = $_GET['Partno'];
	// $description = $_GET['Description'];
	// $maker = $_GET['Maker'];
	// $makercode = $_GET['Makercode'];
	// $lotno = $_GET['Lotno'];
	// $compotype = $_GET['Compotype'];
	// $qty = $_GET['Qty'];
	// $status = $_GET['Status'];
	// $issueddate = $_GET['Issueddate'];
	// $printedby = $_GET['Printedby'];
	// $returned = $_GET['Returned'];
	$model = $_GET['Model'];
	$line = $_GET['Line'];
	// $invoiceno = $_GET['Invoiceno'];
	

	$exist = PartsRecords::checkPart($account, $did);

	if ($exist == 'false') {
		$Partsrecords = new Partsrecords();
		$Partsrecords->setDID($did);
		$Partsrecords->setStatus('PDN');
		$Partsrecords->setIssuedby($name);
		$Partsrecords->setLine($line);
		$Partsrecords->setModel($model);
		$Partsrecords->issuePart();

		echo 'ok';
	} else {
		echo 'fail';
	}


			
	
?>