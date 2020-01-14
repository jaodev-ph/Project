<?php

include_once("../classes/modelroute.php");
include_once("../classes/station.php");
include_once("../classes/card.php");
include_once("../classes/batch.php");
include_once("../classes/mother.php");
include_once("../classes/logpass.php");
include_once("../classes/logbatch.php");
include_once("../classes/logmother.php");
include_once("../classes/repair.php");
include_once("../classes/motherrepair.php");
include_once("../classes/batchrepair.php");

session_start();

	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serialno = explode(" ",$_GET['serialno']);
	$station = explode(":",$_GET['station']);
	$result = "";
	$line = '';


	$hrejectcat = json_decode($_GET['hrejectcat']);
	$hrejectcode = json_decode($_GET['hrejectcode']);
	$hlocation = json_decode($_GET['hlocation']);
	$hdetails = json_decode($_GET['hdetails']);
	$hRejectQty = json_decode($_GET['hRejectQty']);
	
  $motherexist = Mother::checkExist($account,$serialno[0]);
  $batchexist = Batch::checkExist($account,$serialno[0]);
  $cardexist = Card::checkExist($account,$serialno[0]);

  if ($cardexist == 'true'){

	$repair = new Repair();

	for($i=0;$i<count($hrejectcat);$i++){

			$rejectcat = explode(":",$hrejectcat[$i]);
			$rejectcode = explode(":",$hrejectcode[$i]);
			
            $repair->setAccount($account);
            $repair->setCardno($serialno[0].'_1');
            $repair->setStage('RTS');
            $repair->setMachine('');
            $repair->setCategory($rejectcat[0]);
            $repair->setDefect($rejectcode[0]);
            $repair->setLocation($hlocation[$i]);
            $repair->setDetails($hdetails[$i]);
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

    $Card = new Card();
	$Card->setAccount($account);
	$Card->setCardNo($serialno[0]);
	$Card->setStatus('REJECT');
	$Card->setLotno('');
	$Card->setLotType('');
	$Card->setCurtStage($station[0]);
	$Card->setLastUpdatedBy($name);
	$Card->updateStatusRTS();
			
	$Logpass = new LogPass();
	$Logpass->setAccount($account);
	$Logpass->setLine($line);
	$Logpass->setCardNo($serialno[0]);
	$Logpass->setSequence(0);
	$Logpass->setMachine('');
	$Logpass->setStation('RTS');
	$Logpass->setStatus('REJECT');
	$Logpass->setLastUpdatedBy($name);
	$Logpass->addLogpass();

		    echo 'successreject'."_".$serialno[0];


  }else if ($batchexist == 'true'){

  	$quantity = $_GET['qty'];
  	$total = 0;

	$batchrepair = new BatchRepair();

	for($x=0;$x<count($hRejectQty);$x++){
		$total += (int) $hRejectQty[$x];
	}

$currentQty = $quantity - $total;

	for($i=0;$i<count($hrejectcat);$i++){

			$rejectcat = explode(":",$hrejectcat[$i]);
			$rejectcode = explode(":",$hrejectcode[$i]);
			
            $batchrepair->setAccount($account);
            $batchrepair->setCardno($serialno[0].'_1');
            $batchrepair->setStage('RTS');
            $batchrepair->setMachine('');
            $batchrepair->setCategory($rejectcat[0]);
            $batchrepair->setDefect($rejectcode[0]);
            $batchrepair->setLocation($hlocation[$i]);
            $batchrepair->setDetails($hdetails[$i]);
            $batchrepair->setCurrquantity($total);
         
            $batchrepair->setStatus('0');
            $batchrepair->setAddInfo('');
            $batchrepair->setSerialAffected('');
            $batchrepair->setComponent('');
            $batchrepair->setRemarks('');
            $batchrepair->setRejectUser($name);
            $batchrepair->setRepairUser('');
            $batchrepair->setLastUpdatedBy($name);
            $batchrepair->addRepair();

    }
    
    $Batch = new batch();
	$Batch->setAccount($account);
	$Batch->setCardNo($serialno[0]);
	$Batch->setStatus('REJECT');
	$Batch->setCurtStage($station[0]);
	$Batch->setLotno('');
	$Batch->setRefno('');
	$Batch->setLastUpdatedBy($name);
	$Batch->setCurrquantity($currentQty);
	$Batch->setLineCode($line);
	$Batch->updateStatusRTS();
			
	$LogBatch = new LogBatch();
	$LogBatch->setAccount($account);
	$LogBatch->setLine($line);
	$LogBatch->setBatchno($serialno[0]);
	$LogBatch->setCurtstage('RTS');
	$LogBatch->setCurrquantity($quantity);
	$LogBatch->setStatus('REJECT');
	$LogBatch->setRemarks('');
	$LogBatch->setDisquantity($total);
	$LogBatch->setLastUpdatedBy($name);
	$LogBatch->addLogbatch();

    echo 'successreject'."_".$serialno[0];

  }/*else if ($motherexist == 'true'){


	$motherrepair = new MotherRepair();

	for($x=0;$x<count($hRejectQty);$x++){
		$total += (int) $hRejectQty[$x];
	}

$currentQty = $quantity - $total;

	for($i=0;$i<count($hrejectcat);$i++){

			$rejectcat = explode(":",$hrejectcat[$i]);
			$rejectcode = explode(":",$hrejectcode[$i]);
			
            $motherrepair->setAccount($account);
            $motherrepair->setCardno($serialno[0].'_1');
            $motherrepair->setStage($station[0]);
         	$motherrepair->setChildPartno($hrejectchild[$i]);
            $motherrepair->setMachine('');
            $motherrepair->setCategory($rejectcat[0]);
            $motherrepair->setDefect($rejectcode[0]);
            $motherrepair->setLocation('RTS');
            $motherrepair->setDetails($hdetails[$i]);
            $motherrepair->setStatus('0');
            $motherrepair->setQuantity($total);
            $motherrepair->setAddInfo('');
            $motherrepair->setSerialAffected('');
            $motherrepair->setComponent('');
            $motherrepair->setRemarks('');
            $motherrepair->setRejectUser($name);
            $motherrepair->setRepairDate('');
            $motherrepair->setRepairUser('');
            $motherrepair->setLastUpdatedBy($name);
            $motherrepair->addRepair();

	$LogMother = new LogMother();
	$LogMother->setAccount($account);
	$LogMother->setLine($line);
	$LogMother->setMotherSerial($serialno[0]);
	$LogMother->setStage('RTS');
	$LogMother->setCurrquantity($quantity);
	$LogMother->setStatus('REJECT');
	$LogMother->setRemarks('');
	$LogMother->setChildPartno($hrejectchild[$i]);
	$LogMother->setDisquantity($total);
	$LogMother->setLastUpdatedBy($name);
	$LogMother->addLogMother();
    }
    
    $Mother = new Mother();
	$Mother->setAccount($account);
	$Mother->setCardNo($serialno[0]);
	$Mother->setStatus('REJECT');
	$Mother->setCurtStation($station[0]);
	$Mother->setLastUpdatedBy($name);
	$Mother->setCurrquantity($currentQty);
	$Mother->setLineCode($line);
	$Mother->updateStatus();

 echo 'successreject'."_".$serialno[0]."_".'test1';

   
  }*/else{
  	echo 'error_1';
  }


?>