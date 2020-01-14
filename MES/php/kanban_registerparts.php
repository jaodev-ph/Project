<?php
include_once("../classes/kanban_partsrecords.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$did = $_GET['DID'];
	$ipn = $_GET['IPN'];
	$partno = $_GET['Partno'];
	$description = $_GET['Description'];
	$maker = $_GET['Maker'];
	$makercode = $_GET['Makercode'];
	$lotno = $_GET['Lotno'];
	$compotype = $_GET['Compotype'];
	$qty = $_GET['Qty'];
	// $status = $_GET['Status'];
	// $printeddate = $_GET['Printeddate'];
	// $printedby = $_GET['Printedby'];
	// $returned = $_GET['Returned'];
	// $remarks = $_GET['Remarks'];
	// $model = $_GET['Model'];
	
	$invoiceno = $_GET['Invoiceno'];


	$checkifexist = Partsrecords::partCheck($account, $did, $partno);

	if ($checkifexist == "false") {
		// echo "<script>console.log( 'Debug Objects: " . $did . "' );</script>";

		$Partsrecords = new Partsrecords();
			$Partsrecords->setAccount($account);
			$Partsrecords->setDID(strtoupper($did));
			$Partsrecords->setIPN(strtoupper($partno));
			$Partsrecords->setPartno(strtoupper($ipn));
			$Partsrecords->setDescription($description);
			$Partsrecords->setMaker($maker);
			$Partsrecords->setMakercode($makercode);
			$Partsrecords->setLotno($lotno);
			$Partsrecords->setCompotype($compotype);
			$Partsrecords->setQty($qty);
			$Partsrecords->setStatus('WHS');
			$Partsrecords->setPrintedby($name);
			$Partsrecords->setReturned(0);
			$Partsrecords->setLine('0');
			$Partsrecords->setInvoiceno($invoiceno);
			$Partsrecords->setModel('');
			$Partsrecords->setIssuedby('');
			$Partsrecords->setMountedby('');

			$Partsrecords->registerPart();

			/*$Partsrecords1 = new Partsrecords();
			$Partsrecords1->setDID($did);
			$Partsrecords1->setIPN($ipn);
			$Partsrecords1->setQty($qty);
			$Partsrecords1->setDescription($description);
			$Partsrecords1->setStatus('WHS');
			$Partsrecords1->setLine('4');
			$Partsrecords1->setPrintedby($name);*/

			$Partsrecords->registerPartlogs();

		echo 'ok';
	} else {
		echo "fail";
	}
			
	
?>