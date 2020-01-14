<?php
include_once("../classes/card.php");
include_once("../classes/batch.php");
include_once("../classes/serialformat.php");
include_once("../classes/logbatch.php");
include_once("../classes/logpass.php");
include_once("../classes/logmother.php");
include_once("../classes/station.php");
include_once("../classes/repair.php");
include_once("../classes/mother.php");
include_once("../classes/linking.php");
include_once("../classes/modelroute.php");
include_once("../classes/model.php");

session_start();

$account = trim($_SESSION['account']);
$name = trim($_SESSION['name']);
$model1 = $_GET['model'];

if ($model1=='Best Buy - MA') {


$model = 'Best Buy';
$motherserial = explode(" ",$_GET['serialno1']);
$serialno = explode(" ",$_GET['serialno4']);
$motherqty = $_GET['qty1'];
$serialqty = '1';
$line = $_GET['line'];
$qty = 0;

$fullstation = $_GET['station'];
$splitstation = explode(":", $fullstation);
$station = $splitstation[0];
$description = trim($splitstation[1]);
$proceed = false;

$serialexist = Card::checkExist($account,$serialno[0]);

$SerialFormat = SerialFormat::SelectSerialFormat(trim($account),$model);

$countserial = Link2::getcountseriallink($account,$motherqty[0]);
	
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
				echo 'Serial Already Exist! '.$serialno[0];
				return;
			}else{

					$qty += $motherqty - $serialqty;

				if ($qty == 0) {

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
			$Card->setLotType('');
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

	$link = new Link2();
	$link->setAccount($account);
	$link->setSerialNo($motherserial[0]);
	$link->setSerialNoLink($serialno[0]);
	$link->setPartNo($model1);
	$link->setPartNoLink($model);
	$link->setQty($serialqty);
	$link->setStation($station);
	$link->setDescription($description);
	$link->setLastUpdatedBy($name);
	$link->addLogLink();


$childmodel = Model::SelectChildModel($account,$model1);

for($i=0;$i<count($childmodel);$i++){

		$Mother = new Mother();
			$Mother->setAccount($account);
			$Mother->setCardNo($motherserial[0]);
			$Mother->setStatus('GOOD');
			$Mother->setCurtstation($station);
			$Mother->setLastUpdatedBy($name);
			$Mother->updateStatus();

			$LogMother = new LogMother();
			$LogMother->setAccount($account);
			$LogMother->setLine($line);
			$LogMother->setMotherSerial($motherserial[0]);
			$LogMother->setChildPartNo($childmodel[$i]->getModel());
			$LogMother->setStage($station);
			$LogMother->setStatus('GOOD');
			$LogMother->setLastUpdatedBy($name);
			$LogMother->setCurrquantity($countserial);
			$LogMother->setDisquantity(0);
			$LogMother->setRemarks('Link');
			$LogMother->addLogMother();
		}

					echo 'success_'.$serialno[0].'_'.$motherqty.'_'.$countserial.'_'.$model.'_'.$line.'_'.$fullstation.'_'.'GOOD'.'_'.$name;

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
			$Card->setLotType('');
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

	$link = new Link2();
	$link->setAccount($account);
	$link->setSerialNo($motherserial[0]);
	$link->setSerialNoLink($serialno[0]);
	$link->setPartNo($model1);
	$link->setPartNoLink($model);
	$link->setQty($serialqty);
	$link->setStation($station);
	$link->setDescription($description);
	$link->setLastUpdatedBy($name);
	$link->addLogLink();

			$Station = new Station();
			$Station->StationDetails($account,$station);
			$discription = $Station->getDescription();


			echo 'info_'.$serialno[0].'_'.$qty.'_'.$countserial.'_'.$model.'_'.$line.'_'.$fullstation.'_'.'GOOD'.'_'.$name;
		}
			}	
		}else{
			echo 'Serial Error! '.$serialno[0];
				return;
		}
	}else{
		echo 'Wrong Serial Format! '.$serialno[0];
				return;
	}

}elseif($model1=='Car Charger - MA'){

$model = 'Car Charger';
$motherserial = explode(" ",$_GET['serialno1']);
$serialno = explode(" ",$_GET['serialno4']);
$motherqty = $_GET['qty1'];
$serialqty = '16';
$line = $_GET['line'];
$qty = 0;
$type = '';

$fullstation = $_GET['station'];
$splitstation = explode(":", $fullstation);
$station = $splitstation[0];
$description = trim($splitstation[1]);
$proceed = false;

$serialexist = Batch::checkExist($account,$serialno[0]);

$SerialFormat = SerialFormat::SelectSerialFormat(trim($account),$model);

$countserial = Link2::getcountseriallink($account,$motherqty[0]);
	
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
				echo 'Serial Already Exist! '.$serialno[0];
				return;
			}else{

					$qty += $motherqty - $serialqty;

				if ($qty == 0) {
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
			$Batch->setOrigquantity($serialqty);
			$Batch->setCurrquantity($serialqty);
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
			$LogBatch->setCurrquantity($serialqty);
			$LogBatch->setDisquantity(0);
			$LogBatch->addLogbatch();

	$link = new Link2();
	$link->setAccount($account);
	$link->setSerialNo($motherserial[0]);
	$link->setSerialNoLink($serialno[0]);
	$link->setPartNo($model1);
	$link->setPartNoLink($model);
	$link->setQty($serialqty);
	$link->setStation($station);
	$link->setDescription($description);
	$link->setLastUpdatedBy($name);
	$link->addLogLink();


$childmodel = Model::SelectChildModel($account,$model1);

for($i=0;$i<count($childmodel);$i++){

		$Mother = new Mother();
			$Mother->setAccount($account);
			$Mother->setCardNo($motherserial[0]);
			$Mother->setStatus('GOOD');
			$Mother->setCurtstation($station);
			$Mother->setLastUpdatedBy($name);
			$Mother->updateStatus();

			$LogMother = new LogMother();
			$LogMother->setAccount($account);
			$LogMother->setLine($line);
			$LogMother->setMotherSerial($motherserial[0]);
			$LogMother->setChildPartNo($childmodel[$i]->getModel());
			$LogMother->setStage($station);
			$LogMother->setStatus('GOOD');
			$LogMother->setLastUpdatedBy($name);
			$LogMother->setCurrquantity($countserial);
			$LogMother->setDisquantity(0);
			$LogMother->setRemarks('Link');
			$LogMother->addLogMother();
		}

					echo 'success_'.$serialno[0].'_'.$motherqty.'_'.$countserial.'_'.$model.'_'.$line.'_'.$fullstation.'_'.'GOOD'.'_'.$name;

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
			$Batch->setOrigquantity($serialqty);
			$Batch->setCurrquantity($serialqty);
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
			$LogBatch->setCurrquantity($serialqty);
			$LogBatch->setDisquantity(0);
			$LogBatch->addLogbatch();

	$link = new Link2();
	$link->setAccount($account);
	$link->setSerialNo($motherserial[0]);
	$link->setSerialNoLink($serialno[0]);
	$link->setPartNo($model1);
	$link->setPartNoLink($model);
	$link->setQty($serialqty);
	$link->setStation($station);
	$link->setDescription($description);
	$link->setLastUpdatedBy($name);
	$link->addLogLink();

			$Station = new Station();
			$Station->StationDetails($account,$station);
			$discription = $Station->getDescription();


			echo 'info_'.$serialno[0].'_'.$qty.'_'.$countserial.'_'.$model.'_'.$line.'_'.$fullstation.'_'.'GOOD'.'_'.$name;
		}
			}	
		}else{
			echo 'Serial Error! '.$serialno[0];
				return;
		}
	}else{
		echo 'Wrong Serial Format! '.$serialno[0];
				return;
	}
}



?>