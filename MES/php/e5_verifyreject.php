<?php

include_once("../classes/modelroute.php");
include_once("../classes/station.php");
include_once("../classes/batch.php");
include_once("../classes/logbatch.php");
include_once("../classes/batchrepair.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serialno = explode(" ",$_GET['serialno']);
	$line ='';
	$station = explode(":",$_GET['station']);
	$total = 0;
	$qty = $_GET['Qty'];
	$trackRepair = json_decode($_GET['trackRepair']);
	$trackremarks = json_decode($_GET['trackremarks']);
	$hqty = json_decode($_GET['hqty']);



	for($i=0;$i<count($trackRepair);$i++){
		$trackRepair1 = $trackRepair[$i];
		$trackremarks1 = $trackremarks[$i];
		BatchRepair::updateRepair($account,$trackRepair1,$serialno[0],$name,$trackremarks1);

	}

	$rejectCount = BatchRepair::countReject($account,$serialno[0]);
	

	for($x=0;$x<count($hqty);$x++){
		$total += (int) $hqty[$x];
	}

$gettotal = $total + (int) $qty;

	if($rejectCount == 'false'){

			$Batch = new Batch();
			$Batch->setAccount($account);
			$Batch->setBatchno($serialno[0]);
			$Batch->setLastUpdatedBy($name);
			$Batch->setCurrquantity($gettotal);
			$Batch->updateQty();

			$LogBatch = new LogBatch();
			$LogBatch->setAccount($account);
			$LogBatch->setBatchno($serialno[0]);
			// $LogBatch->setSequence(0);
			// $LogBatch->setMachine('');
			$LogBatch->setCurtstage($station[0]);
			$LogBatch->setStatus('VERIFY');
			$LogBatch->setLastUpdatedBy($name);
			$LogBatch->setCurrquantity($qty);
			$LogBatch->setDisquantity($total);
			$LogBatch->addLogbatch();

	}

	echo 'success_'.$serialno[0]."_".$gettotal;



?>