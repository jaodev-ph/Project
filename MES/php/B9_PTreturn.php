<?php

include_once("../classes/modelroute.php");
include_once("../classes/station.php");
include_once("../classes/batch.php");
include_once("../classes/logbatch.php");
include_once("../classes/repair.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serialno = explode(" ",$_GET['serialno']);
	$line ='';
	$station = explode(":",$_GET['station']);
	$newstation = explode(":",$_GET['newstation']);
	$qty = $_GET['qty'];
	$Model = $_GET['model'];
	
	$ModelRoute = new ModelRoute();
	$ModelRoute->setAccount($account);
	$ModelRoute->setStation($newstation[0]);
	$ModelRoute->setModelNo($Model);
	$ModelRoute->getStationDetails2();

		$Batch = new Batch();
			$Batch->setAccount($account);
			$Batch->setCardNo($serialno[0]);
			$Batch->setStatus('GOOD');
			$Batch->setCurtStage($ModelRoute->getpreviousstage2($account,$Model,$ModelRoute->getFlowsequence()));
			$Batch->setLastUpdatedBy($name);
			$Batch->setCurrquantity($qty);
			$Batch->updateStatus();
	

			$LogBatch = new LogBatch(); 
			$LogBatch->setAccount($account);
			$LogBatch->setBatchno($serialno[0]);
			// $LogBatch->setSequence(0);
			// $LogBatch->setMachine('');
			$LogBatch->setCurtstage($ModelRoute->getpreviousstage2($account,$Model,$ModelRoute->getFlowsequence()));
			$LogBatch->setRemarks('RETURN TO '.$newstation[0]);
			$LogBatch->setStatus('GOOD');
			$LogBatch->setLastUpdatedBy($name);
			$LogBatch->setCurrquantity($qty);
			$LogBatch->setDisquantity(0);
			$LogBatch->addLogbatch();

	// $Logpass = new LogPass();
	// $Logpass->setAccount($account);
	// $Logpass->setLine($line);
	// $Logpass->setCardNo($serialno[0]);
	// $Logpass->setSequence(0);
	// $Logpass->setMachine('');
	// $Logpass->setStation($station[0]);
	// $Logpass->setStatus('GOOD');
	// $Logpass->setLastUpdatedBy($name);
	// $Logpass->addLogpass();


	echo 'successReturn_'.$serialno[0];



?>