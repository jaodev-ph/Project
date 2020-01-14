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
	$line = $_GET['line'];
	$quantity = $_GET['Qty'];
	$station = explode(":",$_GET['station']);
	$nextStation = explode(":",$_GET['nextStation']);
	$result = "";
	$total = 0;
	$Quantity1 = $_GET['quantity'];
	$count = $_GET['count'];

	$hrejectcat = json_decode($_GET['hrejectcat']);
	$hrejectcode = json_decode($_GET['hrejectcode']);
	$hlocation = json_decode($_GET['hlocation']);
	$hdetails = json_decode($_GET['hdetails']);
	$hRejectQty = json_decode($_GET['hRejectQty']);

	$repair = new BatchRepair();

	for($x=0;$x<count($hRejectQty);$x++){
		$total += (int) $hRejectQty[$x];
	}

$currentQty = (int)$quantity - $total;

	for($i=0;$i<count($hrejectcat);$i++){

			$rejectcat = explode(":",$hrejectcat[$i]);
			$rejectcode = explode(":",$hrejectcode[$i]);
			
            $repair->setAccount($account);
            $repair->setCardno($serialno[0].'_1');
            $repair->setStage($station[0]);
            $repair->setMachine('');
            $repair->setCategory($rejectcat[0]);
            $repair->setDefect($rejectcode[0]);
            $repair->setLocation($hlocation[$i]);
            $repair->setDetails($hdetails[$i]);
            $repair->setCurrquantity($total);
         
            $repair->setStatus('0');
            $repair->setAddInfo('');
            $repair->setSerialAffected('');
            $repair->setComponent('');
            $repair->setRemarks('');
            $repair->setRejectUser($name);
            $repair->setRepairUser('');
            $repair->setLastUpdatedBy($name);
            $repair->addRepair();

    }
    
    $Batch = new batch();
	$Batch->setAccount($account);
	$Batch->setCardNo($serialno[0]);
	$Batch->setStatus('REJECT');
	$Batch->setCurtStage($station[0]);
	$Batch->setLastUpdatedBy($name);
	$Batch->setCurrquantity($currentQty);
	$Batch->getLineCode($line);
	$Batch->updateStatus();
			
	$LogBatch = new LogBatch();
	$LogBatch->setAccount($account);
	$LogBatch->setLine($line);
	$LogBatch->setBatchno($serialno[0]);
	//$Logpass->setSequence(0);
	// $Logpass->setMachine('');
	$LogBatch->setCurtstage($station[0]);
	$LogBatch->setCurrquantity($quantity);
	$LogBatch->setStatus('REJECT');
	$LogBatch->setRemarks('');
	$LogBatch->setDisquantity($total);
	$LogBatch->setLastUpdatedBy($name);
	$LogBatch->addLogbatch();

    //echo 'successreject'."_".$serialno[0];


  	if(intval($Quantity1) == intval($count) + 1){
		$counter = intval($count) + 1;
		echo 'successreject_'.$serialno[0]."_".$counter."_".$currentQty."_REJECT";

	}else{
		$counter = intval($count) + 1;
		echo 'false_'.$_GET['serialno']."_".$counter."_".$currentQty."_REJECT";	
	 }

?>