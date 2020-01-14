<?php
include_once("../classes/kanban_partsrecords.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];

	
	$partno = $_GET['Partno'];
	$did =  $_GET['DID'];
	$description = $_GET['Description'];
	$maker = $_GET['Maker'];
	$lotno = $_GET['Lotno'];
	$compotype = $_GET['Compotype'];
	$qty = $_GET['Qty'];
	$status = $_GET['Status'];
	$printeddate = $_GET['Pdate'] ;
	$printedby = $_GET['Regby'];
	$model = $_GET['Model'];
	// $invoiceno = $_GET['Invoiceno'];
	$ipn = $_GET['IPN'];

	$exist = Partsrecords::didCheck($account, $did);

	if ($exist == 'true') {

			$Partsrecords = new Partsrecords();
			$Partsrecords->setPartno($partno);
			$Partsrecords->setIPN($ipn);
			$Partsrecords->setDescription($description);
			$Partsrecords->setMaker($maker);
			$Partsrecords->setLotno($lotno);
			$Partsrecords->setCompotype($compotype);
			$Partsrecords->setQty($qty);
			$Partsrecords->setStatus($status);
			$Partsrecords->setPrinteddate($printeddate);
			$Partsrecords->setPrintedby($printedby);
			$Partsrecords->setModel($model);
			// $Partsrecords->setInvoiceno($invoiceno);
			$Partsrecords->didInfo($did);

		echo 'ok_'.$Partsrecords->getPartno()."_".$Partsrecords->getIPN()."_".$Partsrecords->getMaker()."_".$Partsrecords->getLotno()."_".$Partsrecords->getPrintedby()."_".$Partsrecords->getStatus()."_".$Partsrecords->getDescription()."_".$Partsrecords->getCompotype()."_".$Partsrecords->getQty()."_".$Partsrecords->getModel()."_".date_format($Partsrecords->getPrinteddate(), 'Y-m-d H:i:s');
		
	} else {
		echo "notok";
	}


			
	
?>