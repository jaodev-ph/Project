<?php

include_once("../classes/modelroute.php");
include_once("../classes/station.php");
include_once("../classes/mother.php");
include_once("../classes/batch.php");
include_once("../classes/card.php");
include_once("../classes/logpass.php");
include_once("../classes/logbatch.php");
include_once("../classes/logmother.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serialno = explode(" ",$_GET['serialno']);
	$line ='';
	$station = explode(":",$_GET['station']);
	$newstation = explode(":",$_GET['newstation']);
	$Model = $_GET['model'];
	$qty = $_GET['qty'];


	$ModelRoute = new ModelRoute();
	$ModelRoute->setAccount($account);
	$ModelRoute->setStation($newstation[0]);
	$ModelRoute->setModelNo($Model);
	$ModelRoute->getStationDetails2();
	// $ModelRoute->getpreviousstage1($account,$Model,$ModelRoute->getFlowsequence())

  $motherexist = Mother::checkExist($account,$serialno[0]);
  $batchexist = Batch::checkExist($account,$serialno[0]);
  $cardexist = Card::checkExist($account,$serialno[0]);

if ($motherexist == 'true'){

	$Mother = new Mother();
	$Mother->setAccount($account);
	$Mother->setCardNo($serialno[0]);
	$Mother->setStatus('GOOD');
	$Mother->setCurtStation($ModelRoute->getpreviousstage2($account,$Model,$ModelRoute->getFlowsequence()));
	$Mother->setLastUpdatedBy($name);
	$Mother->updateStatus();
	
		$LogMother = new LogMother();
		$LogMother->setAccount($account);
		$LogMother->setLine($line);
		$LogMother->setMotherSerial($serialno[0]);
		$LogMother->setChildPartNo('');
		$LogMother->setStage($station[0]);
		$LogMother->setStatus('GOOD');
		$LogMother->setLastUpdatedBy($name);
		$LogMother->setCurrquantity(0);
		$LogMother->setDisquantity(0);
		$LogMother->setRemarks('RETURN TO '.$ModelRoute->getpreviousstage2($account,$Model,$ModelRoute->getFlowsequence()));
		$LogMother->addLogMother();

	echo 'successReturn_'.$serialno[0];


} else if ($batchexist == 'true'){

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
		
			$LogBatch->setCurtstage($ModelRoute->getpreviousstage2($account,$Model,$ModelRoute->getFlowsequence()));
			$LogBatch->setRemarks('RETURN TO '.$newstation[0]);
			$LogBatch->setStatus('GOOD');
			$LogBatch->setLastUpdatedBy($name);
			$LogBatch->setCurrquantity($qty);
			$LogBatch->setDisquantity(0);
			$LogBatch->addLogbatch();

			echo 'successReturn_'.$serialno[0];

} else if ($cardexist == 'true'){

	$Card = new Card();
	$Card->setAccount($account);
	$Card->setCardNo($serialno[0]);
	$Card->setStatus('GOOD');
	$Card->setCurtStage($ModelRoute->getpreviousstage2($account,$Model,$ModelRoute->getFlowsequence()));
	$Card->setLastUpdatedBy($name);
	$Card->updateStatus();

	$Logpass = new LogPass();
	$Logpass->setAccount($account);
	$Logpass->setLine('');
	$Logpass->setCardNo($serialno[0]);
	$Logpass->setSequence(0);
	$Logpass->setMachine('');
	$Logpass->setStation('RETURN TO '.$newstation[0]);
	$Logpass->setStatus('GOOD');
	$Logpass->setLastUpdatedBy($name);
	$Logpass->addLogpass();

	echo 'successReturn_'.$serialno[0];

}


?>