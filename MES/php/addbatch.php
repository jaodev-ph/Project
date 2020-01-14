<?php
include_once("../classes/batch.php");
include_once("../classes/serialformat.php");
include_once("../classes/logbatch.php");
include_once("../classes/station.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];

	$serialno = explode(" ",$_GET['serialno']);
	$station ='001';
	$model = $_GET['model'];
	$line = $_GET['line'];
	$type = $_GET['type'];
	$quantity = $_GET['quantity'];
	$proceed = false;
	
	$SerialFormat = SerialFormat::SelectSerialFormat(trim($account),$model);

	$sub_serial = substr($serialno[0],intval($SerialFormat[0]->getStart()),intval($SerialFormat[0]->getLast()));
	
	if($SerialFormat[0]->getAllowFormat() == 0){
		$proceed =true;
	
	}else{
		if($SerialFormat[0]->getValue() == $sub_serial)
		{
		$proceed = true;
		}else{
		$proceed = false;
		}
	}

	if(strlen($serialno[0]) == $SerialFormat[0]->getSerialLength()){

		if($proceed  == true)
		{
			$exist = Batch::checkExist($account,$serialno[0]);

			if($exist == 'true'){
				echo 'error1_'.$_GET['serialno'];
			}else{
				
			$Batch = new Batch();
			$Batch->setAccount($account);
			$Batch->setCardNo($serialno[0]);
			$Batch->setBatchno($serialno[0]);
			// $Batch->setSystem21('');
			$Batch->setWorkorder('');
			$Batch->setPartNo($model);
			$Batch->setRevision('');
			$Batch->setLineCode($line);
			$Batch->setRefno('');
			$Batch->setHoldFlag(0);
			$Batch->setPackFlag(0);
			$Batch->setShipFlag(0);
			$Batch->setRTVFlag(0);
			$Batch->setRejectFlag(0);
			$Batch->setStatus('GOOD');
			$Batch->setLotno('');
			$Batch->setLotType('');
			$Batch->setCurtStage($station);
			$Batch->setLotType($type);
			$Batch->setLastUpdatedBy($name);
			$Batch->setParentbatchno('');
			$Batch->setChildbatchno('');
			$Batch->setOrigquantity($quantity);
			$Batch->setCurrquantity($quantity);
			$Batch->addBatch();

			$LogBatch = new LogBatch();
			$LogBatch->setAccount($account);
			$LogBatch->setLine($line);
			$LogBatch->setBatchno($serialno[0]);
			// $LogBatch->setSequence(0);
			// $LogBatch->setMachine('');
			$LogBatch->setCurtstage($station);
			$LogBatch->setStatus('GOOD');
			$LogBatch->setLastUpdatedBy($name);
			$LogBatch->setCurrquantity($quantity);
			$LogBatch->setDisquantity(0);
			$LogBatch->addLogbatch();


			$Station = new Station();
			$Station->StationDetails($account,$station);
			$discription = $Station->getDescription();


			echo 'success_'.$_GET['serialno']."_".$model."_".$type."_".$line."_".$discription."_"."GOOD"."_".$name;
			}	
		}else{
			echo 'error2_'.$_GET['serialno'];
		}
	}else{
		echo 'error3_'.$_GET['serialno'];
	}
	

			


?>