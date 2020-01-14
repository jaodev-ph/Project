<?php
include_once("../classes/kanban_partsrecords.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];

	
	$partno = $_GET['Partno'];
	$did =  $_GET['DID'];
	$description = $_GET['Description'];
	$maker = $_GET['Maker'];
	$makercode = $_GET['Makercode'];
	$lotno = $_GET['Lotno'];
	$compotype = $_GET['Compotype'];
	$qty = $_GET['Qty'];
	$status = $_GET['Status'];
	// $printeddate = $_GET['Printeddate'] ;
	$printedby = $_GET['Printedby'];
	$invoiceno = $_GET['Invoiceno'];
	$ipn = $_GET['IPN'];

	$exist = Partsrecords::didCheck($account, strtoupper($did));

	if ($exist == 'true') {
		   $Partsrecords = new Partsrecords();
			$Partsrecords->setPartno($partno);
			$Partsrecords->setIPN($ipn);
			$Partsrecords->setDescription($description);
			$Partsrecords->setMaker($maker);
			$Partsrecords->setMakercode($makercode);
			$Partsrecords->setLotno($lotno);
			$Partsrecords->setCompotype($compotype);
			$Partsrecords->setQty($qty);
			$Partsrecords->setStatus($status);
			// $Partsrecords->setPrinteddate($printeddate);
			$Partsrecords->setPrintedby($printedby);
			$Partsrecords->setInvoiceno($invoiceno);
			$Partsrecords->didInfo($did);
 			$new_time = Partsrecords::StartTime();
			if($Partsrecords->getCompotype() == 'SP-Solder Paste' || $Partsrecords->getCompotype() == 'P-PWB' || $Partsrecords->getCompotype() == 'NM-NAMICS'){

				if($Partsrecords->getThawdate() == '1900-01-01' || $Partsrecords->getThawdate() == '2000-01-01')
			{
					echo "notready";
				}else{

				if($new_time < $Partsrecords->getExpdate()){
					echo 'ok_'.$Partsrecords->getPartno()."_".$Partsrecords->getIPN()."_".$Partsrecords->getDescription()."_".$Partsrecords->getMaker()."_".$Partsrecords->getMakercode()."_".$Partsrecords->getLotno()."_".$Partsrecords->getCompotype()."_".$Partsrecords->getQty()."_".$Partsrecords->getStatus()."_".$Partsrecords->getPrintedby()."_".$Partsrecords->getInvoiceno();
				}else{
					echo "notready";
				}
			}
		}else{
		echo 'ok_'.$Partsrecords->getPartno()."_".$Partsrecords->getIPN()."_".$Partsrecords->getDescription()."_".$Partsrecords->getMaker()."_".$Partsrecords->getMakercode()."_".$Partsrecords->getLotno()."_".$Partsrecords->getCompotype()."_".$Partsrecords->getQty()."_".$Partsrecords->getStatus()."_".$Partsrecords->getPrintedby()."_".$Partsrecords->getInvoiceno();
		}
		
	} else {
		echo "notok";
	}


			
	
?>