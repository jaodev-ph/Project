<?php
include_once("../classes/card.php");
include_once("../classes/serialformat.php");
include_once("../classes/logpass.php");
include_once("../classes/station.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];

	$serialno = explode(" ",$_GET['serialno']);
	$station ='001';
	$model = $_GET['model'];
	$line = $_GET['line'];
	$type = $_GET['type'];
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
			$exist = Card::checkExist($account,$serialno[0]);

			if($exist == 'true'){
				echo 'error1_'.$_GET['serialno'];
			}else{
				
			$Card = new Card();
			$Card->setAccount($account);
			$Card->setCardNo($serialno[0]);
			$Card->setSerialNo($serialno[0]);
			$Card->setSystem21('');
			$Card->setWorkorder('');
			$Card->setPartNo($model);
			$Card->setRevision('');
			$Card->setLineCode('');
			$Card->setHoldFlag(0);
			$Card->setPackFlag(0);
			$Card->setShipFlag(0);
			$Card->setRTVFlag(0);
			$Card->setRejectFlag(0);
			$Card->setStatus('GOOD');
			$Card->setLotno('');
			$Card->setLotType('');
			$Card->setCurtStage($station);
			$Card->setLotType($type);
			$Card->setLastUpdatedBy($name);
			$Card->addCard();

			$Logpass = new LogPass();
			$Logpass->setAccount($account);
			$Logpass->setLine($line);
			$Logpass->setCardNo($serialno[0]);
			$Logpass->setSequence(0);
			$Logpass->setMachine('');
			$Logpass->setStation($station);
			$Logpass->setStatus('GOOD');
			$Logpass->setLastUpdatedBy($name);
			$Logpass->addLogpass();


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