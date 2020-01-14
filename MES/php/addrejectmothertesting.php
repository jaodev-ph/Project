<?php

include_once("../classes/modelroute.php");
include_once("../classes/station.php");
include_once("../classes/mother.php");
include_once("../classes/logmother.php");
include_once("../classes/motherrepair.php");

session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serialno = explode(" ",$_GET['serialno']);
	/*$lotno = explode(" ",$_GET['lotno']);*/
	$line = $_GET['line'];
	$quantity = $_GET['Qty'];
	$station = explode(":",$_GET['station']);
	$nextStation = explode(":",$_GET['nextStation']);
	$result = "";
	$model =  explode(" ",$_GET['model']);
	$total = 0;

	$hrejectcat = json_decode($_GET['hrejectcat']);
	$hrejectcode = json_decode($_GET['hrejectcode']);
	$hrejectchild = json_decode($_GET['hrejectchild']);
	$hlocation = json_decode($_GET['hlocation']);
	$hdetails = json_decode($_GET['hdetails']);
	$hRejectQty = json_decode($_GET['hRejectQty']);

	$repair = new MotherRepair();

	for($x=0;$x<count($hRejectQty);$x++){
		$total += (int) $hRejectQty[$x];
	}

$currentQty = $quantity - $total;

	for($i=0;$i<count($hrejectcat);$i++){

			$rejectcat = explode(":",$hrejectcat[$i]);
			$rejectcode = explode(":",$hrejectcode[$i]);
			
            $repair->setAccount($account);
            $repair->setCardno($serialno[0].'_1');
            $repair->setStage($station[0]);
         	$repair->setChildPartno($hrejectchild[$i]);
            $repair->setMachine('');
            $repair->setCategory($rejectcat[0]);
            $repair->setDefect($rejectcode[0]);
            $repair->setLocation($hlocation[$i]);
            $repair->setDetails($hdetails[$i]);
            $repair->setStatus('0');
            $repair->setQuantity($total);
            $repair->setAddInfo('');
            $repair->setSerialAffected('');
            $repair->setComponent('');
            $repair->setRemarks('');
            $repair->setRejectUser($name);
            $repair->setRepairDate('');
            $repair->setRepairUser('');
            $repair->setLastUpdatedBy($name);
            $repair->addRepair();

	$LogBatch = new LogMother();
	$LogBatch->setAccount($account);
	$LogBatch->setLine($line);
	$LogBatch->setMotherSerial($serialno[0]);
	//$Logpass->setSequence(0);
	// $Logpass->setMachine('');
	$LogBatch->setStage($station[0]);
	$LogBatch->setCurrquantity($quantity);
	$LogBatch->setStatus('REJECT');
	$LogBatch->setRemarks('');
	$LogBatch->setChildPartno($hrejectchild[$i]);
	$LogBatch->setDisquantity($total);
	$LogBatch->setLastUpdatedBy($name);
	$LogBatch->addLogMother();
    }

    $ModelRoute = new ModelRoute();
	$ModelRoute->setAccount($account);
	$ModelRoute->setStation($station[0]);
	$ModelRoute->setModelNo($model[0]);
	$ModelRoute->getStationDetails2();
	$getpreviousstage = ModelRoute::getpreviousstage1($account,$model[0],$ModelRoute->getFlowsequence());
    
    $Batch = new Mother();
	$Batch->setAccount($account);
	$Batch->setCardNo($serialno[0]);
	$Batch->setStatus('REJECT');
	$Batch->setCurtStation($station[0]);
	$Batch->setLastUpdatedBy($name);
	$Batch->setCurrquantity($currentQty);
	$Batch->setLineCode($line);
	$Batch->updateStatus();
			



 echo 'successreject'."_".$serialno[0]."_".'test1';

   

?>