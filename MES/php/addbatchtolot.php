<?php
include_once("../classes/batch.php");
include_once("../classes/serialformat.php");
include_once("../classes/logbatch.php");
include_once("../classes/station.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$line =$_GET['line'];
	$serialno = explode(" ",$_GET['serialno']);
	$RQuantity = $_GET['RQuantity'];
	$lotno = $_GET['lotno'];
	$station = explode(":",$_GET['station']);
	$Serial = new Batch($account,$serialno[0]);
	$quantity = $_GET['Quantity'];
	$totalqty = $_GET['total'];

	
	if($Serial->getLotno() == ""){
			$Card = new Batch();
			$Card->setAccount($account);
			$Card->setCardNo($serialno[0]);
			$Card->setStatus('GOOD');
			$Card->setLineCode($line);
			$Card->setCurtStage($station[0]);
			$Card->setLastUpdatedBy($name);
			$Card->setCurrquantity($quantity);
			$Card->updateStatus();
			$Card->setLotno($lotno);
			$Card->updatetheLotno();

			$LogBatch = new LogBatch();
			$LogBatch->setAccount($account);
			$LogBatch->setLine($line);
			$LogBatch->setBatchno($serialno[0]);
			// $LogBatch->setSequence(0);
			// $LogBatch->setMachine('');
			$LogBatch->setCurtstage($station[0]);
			$LogBatch->setStatus('GOOD');
			$LogBatch->setLastUpdatedBy($name);
			$LogBatch->setCurrquantity($quantity);
			$LogBatch->setDisquantity(0);
			$LogBatch->addLogbatch();

			$lotcount = Batch::getCountSerialByLot($account,$lotno);
			
			$totallotquantity = (int) $totalqty + (int) $quantity;

			if($lotcount == $RQuantity){
			echo 'success_'.$_GET['serialno']."_".$lotcount."_".$totallotquantity."_completed";
			}else{
			echo 'success_'.$_GET['serialno']."_".$lotcount."_".$totallotquantity."_notcompleted";	
			}

		}else{
			echo 'alreadyonlot_'.$_GET['serialno'];
		}


?>