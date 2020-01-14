<?php
include_once("../classes/kanban_partsrecords.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$did = $_GET['DID'];
	$reason = $_GET['Reason'];
	$ipn = $_GET['IPN'];
	//$partno = $_GET['Partno'];
	$description = $_GET['Description'];
	//$maker = $_GET['Maker'];
	//$makercode = $_GET['Makercode'];
	$lotno = $_GET['Lotno'];
	//$compotype = $_GET['Compotype'];
	$qty = $_GET['Qty'];
	$Rquantity = $_GET['Rquantity'];
	// $status = $_GET['Status'];
	// $printeddate = $_GET['Printeddate'];
	// $printedby = $_GET['Printedby'];
	// $returned = $_GET['Returned'];
	// $remarks = $_GET['Remarks'];
	//$model = $_GET['Model'];	
	//$line = $_GET['Line'];
	//$invoiceno = $_GET['Invoiceno'];

	$exist = Partsrecords::checkPartReturned($account, strtoupper($did));

	if ($exist == 'false') {
		$Partsrecords = new Partsrecords();
		$Partsrecords->setDID($did);
		$Partsrecords->setIPN($ipn);
		$Partsrecords->setDescription($description);
		$Partsrecords->setLotno($lotno);
		$Partsrecords->setQty($Rquantity);
		$Partsrecords->setStatus('WHS');
		$Partsrecords->setLine('0');
		$Partsrecords->setReturned(1);
		$Partsrecords->setReason($reason);
		$Partsrecords->setPrintedby($name);
		$Partsrecords->returnPart();
		$Partsrecords->registerPartlogs();

		echo "ok";
	} else {
		echo "notok_".$did;
	}

	
?>