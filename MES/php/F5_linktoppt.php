<?php

include_once("../classes/card.php");
include_once("../classes/logpass.php");
include_once("../classes/modelroute.php");
include_once("../classes/model.php");
include_once("../classes/serialformat.php");
include_once("../classes/linking.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = trim($_SESSION['name']);
	$serialno = explode(" ",$_GET['serial']);
	$motherserial = explode(" ",$_GET['motherserial']);
	$model = $_GET['model'];
	$model1 = 'Wall Charger - TS';
	$station = explode(": ",$_GET['station']);
	$line = $_GET['line'];
	$proceed = false;

	$exist = Card::checkExist($account,$serialno[0]);

	//$getmodel = SerialFormat::SelectSerialFormatFromMother1(trim($account),$serialno[0],$model1);

$splitstation = explode(":", $_GET['station']);
$station1 = $splitstation[0];
$description = trim($splitstation[1]);


	$motherqty = Link2::getsumcountseriallink($account,$motherserial[0]);
	$countserial = Link2::getcountlink($account,$motherserial[0],$model1);

//if ($getmodel == 'Wall Charger - TS') {

$SerialFormat = SerialFormat::SelectSerialFormat(trim($account),$model1);
	
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

	if ($exist == 'true'){
			echo 'error1_'.$serialno[0].'_'.$countserial.'_'.$motherqty;
	return;
	}else{

			$Card = new Card();
			$Card->setAccount($account);
			$Card->setCardNo($serialno[0]);
			$Card->setSerialNo($serialno[0]);
			$Card->setSystem21('');
			$Card->setWorkorder('');
			$Card->setPartNo($model1);
			$Card->setRevision('');
			$Card->setLineCode($line);
			$Card->setHoldFlag(0);
			$Card->setPackFlag(0);
			$Card->setShipFlag(0);
			$Card->setRTVFlag(0);
			$Card->setRejectFlag(0);
			$Card->setStatus('GOOD');
			$Card->setLotno('');
			$Card->setLotType('');
			$Card->setCurtStage($station[0]);
			$Card->setLastUpdatedBy($name);
			$Card->addCard();

			$Logpass = new LogPass();
			$Logpass->setAccount($account);
			$Logpass->setLine($line);
			$Logpass->setCardNo($serialno[0]);
			$Logpass->setSequence(0);
			$Logpass->setMachine('');
			$Logpass->setStation($station[0]);
			$Logpass->setStatus('GOOD');
			$Logpass->setLastUpdatedBy($name);
			$Logpass->addLogpass();

				$link = new Link2();
	$link->setAccount($account);
	$link->setSerialNo($motherserial[0]);
	$link->setSerialNoLink($serialno[0]);
	$link->setPartNo($model);
	$link->setPartNoLink($model1);
	$link->setQty('1');
	$link->setStation($station[0]);
	$link->setDescription($description);
	$link->setLastUpdatedBy($name);
	$link->addLogLink();
	$stotal = Link2::getcountlink($account,$motherserial[0],$model1);
	$mtotal = Link2::getsumcountseriallink($account,$motherserial[0]);

		if ($stotal == '6'){
			
			echo 'success_'.$serialno[0].'_'.$stotal.'_'.$mtotal;
		}else{

		echo 'insert_'.$serialno[0].'_'.$stotal.'_'.$mtotal;

			}

	}
		}else{
			echo 'serialformat_'.$serialno[0].'_'.$countserial.'_'.$motherqty;
				
		}
}else{
		echo 'serialformat_'.$serialno[0].'_'.$countserial.'_'.$motherqty;
				
}

/*}else{
	echo 'notmodel_'.'Serial Not Belong to Model!';
				return;
}*/


?>