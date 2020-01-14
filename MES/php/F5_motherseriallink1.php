<?php
include_once("../classes/card.php");
include_once("../classes/batch.php");
include_once("../classes/logbatch.php");
include_once("../classes/mother.php");
include_once("../classes/serialformat.php");
include_once("../classes/logpass.php");
include_once("../classes/logmother.php");
include_once("../classes/station.php");
include_once("../classes/linking.php");
include_once("../classes/modelroute.php");
include_once("../classes/model.php");
session_start();

$account = $_SESSION['account'];
$name = $_SESSION['name'];
$serialno = explode(" ",$_GET['serialno']);
$model = $_GET['model'];
$station = explode(":",$_GET['station']);
$total1 = 0;
$total2 = 0;
$qtypt1 = $_GET['qtypt1'];
$qtypt2 = $_GET['qtypt2'];
$pt1 = explode(" ",$_GET['pt1']);
$pt2 = explode(" ",$_GET['pt2']);	
$line = $_GET['line'];

$validserialformat1 = SerialFormat::validserialformat($account,$serialno[0],$model);
$countserial = Link2::getcountseriallink($account,$serialno[0]);
$Serial = new Mother($account,$serialno[0]);


$linkstation = new ModelRoute();

$linkstation->setModelNo($model);
$linkstation->setAccount($account);
$linkstation->getLinkStation();


$ModelRoute = new ModelRoute();

	$ModelRoute->setAccount($account);
	$ModelRoute->setStation($Serial->getCurtStation());
	$ModelRoute->setModelNo($Serial->getPartNo());
	$ModelRoute->getStationDetails2();


	$nextstage = $ModelRoute->getnextstage1($account,$Serial->getPartNo(),$ModelRoute->getFlowsequence());

$stage = explode(":",$nextstage);

$splitstation = explode(":", $_GET['station']);
$station1 = $splitstation[0];
$description = trim($splitstation[1]);




$exist = Mother::checkExist($account,$serialno[0]);
//echo $stage[0].'_'.$station[0];


if ($model == 'Wall Charger - MA') {

if($exist == 'true'){


	if($model == $Serial->getPartNo()){

	if($Serial->getStatus() == 'REJECT'){

				echo 'Serial is Reject! '.$serialno[0];
				return;
			}else{

if($stage[0] == $station[0]){

if($validserialformat1=='false'){
	echo 'Incorrect Format! Serial: '.$serialno[0];
	return;
}else{
	

	$total1 = $Serial->getCurrQuantity() + $qtypt1;
	$total2 = $Serial->getCurrQuantity() + $qtypt2;

if ($total1 == '18'){


			$Batch = new Batch();
			$Batch->setAccount($account);
			$Batch->setCardNo($pt1[0]);
			$Batch->setBatchno($pt1[0]);
			// $Batch->setSystem21('');
			$Batch->setWorkorder('');
			$Batch->setPartNo('Wall Charger - PT');
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
			$Batch->setCurtStage($station[0]);
			$Batch->setLotType('');
			$Batch->setLastUpdatedBy($name);
			$Batch->setParentbatchno('');
			$Batch->setChildbatchno('');
			$Batch->setOrigquantity($total1);
			$Batch->setCurrquantity($total1);
			$Batch->addBatch();

			$LogBatch = new LogBatch();
			$LogBatch->setAccount($account);
			$LogBatch->setLine($line);
			$LogBatch->setBatchno($pt1[0]);
			// $LogBatch->setSequence(0);
			// $LogBatch->setMachine('');
			$LogBatch->setCurtstage($station1[0]);
			$LogBatch->setStatus('GOOD');
			$LogBatch->setLastUpdatedBy($name);
			$LogBatch->setCurrquantity($total1);
			$LogBatch->setDisquantity(0);
			$LogBatch->addLogbatch();

				$Batch1 = new Batch();
			$Batch1->setAccount($account);
			$Batch1->setCardNo($pt2[0]);
			$Batch1->setBatchno($pt2[0]);
			// $Batch->setSystem21('');
			$Batch1->setWorkorder('');
			$Batch1->setPartNo('Wall Charger - PB');
			$Batch1->setRevision('');
			$Batch1->setLineCode($line);
			$Batch1->setRefno('');
			$Batch1->setHoldFlag(0);
			$Batch1->setPackFlag(0);
			$Batch1->setShipFlag(0);
			$Batch1->setRTVFlag(0);
			$Batch1->setRejectFlag(0);
			$Batch1->setStatus('GOOD');
			$Batch1->setLotno('');
			$Batch1->setLotType('');
			$Batch1->setCurtStage($station[0]);
			$Batch1->setLotType('');
			$Batch1->setLastUpdatedBy($name);
			$Batch1->setParentbatchno('');
			$Batch1->setChildbatchno('');
			$Batch1->setOrigquantity($total2);
			$Batch1->setCurrquantity($total2);
			$Batch1->addBatch();

			$LogBatch1 = new LogBatch();
			$LogBatch1->setAccount($account);
			$LogBatch1->setLine($line);
			$LogBatch1->setBatchno($pt2[0]);
			// $LogBatch->setSequence(0);
			// $LogBatch->setMachine('');
			$LogBatch1->setCurtstage($station[0]);
			$LogBatch1->setStatus('GOOD');
			$LogBatch1->setLastUpdatedBy($name);
			$LogBatch1->setCurrquantity($total2);
			$LogBatch1->setDisquantity(0);
			$LogBatch1->addLogbatch();

	$link = new Link2();
	$link->setAccount($account);
	$link->setSerialNo($serialno[0]);
	$link->setSerialNoLink($pt1[0]);
	$link->setPartNo($model);
	$link->setPartNoLink('Wall Charger - PT');
	$link->setQty($Serial->getCurrQuantity());
	$link->setStation($station[0]);
	$link->setDescription($description);
	$link->setLastUpdatedBy($name);
	$link->addLogLink();

	$link1 = new Link2();
	$link1->setAccount($account);
	$link1->setSerialNo($serialno[0]);
	$link1->setSerialNoLink($pt2[0]);
	$link1->setPartNo($model);
	$link1->setPartNoLink('Wall Charger - PB');
	$link1->setQty($Serial->getCurrQuantity());
	$link1->setStation($station[0]);
	$link1->setDescription($description);
	$link1->setLastUpdatedBy($name);
	$link1->addLogLink();

$childmodel = Model::SelectChildModel($account,$model);

for($i=0;$i<count($childmodel);$i++){

		$Mother = new Mother();
			$Mother->setAccount($account);
			$Mother->setCardNo($serialno[0]);
			$Mother->setStatus('GOOD');
			$Mother->setCurtstation($station[0]);
			$Mother->setLastUpdatedBy($name);
			$Mother->updateStatus();

			$LogMother = new LogMother();
			$LogMother->setAccount($account);
			$LogMother->setLine($line);
			$LogMother->setMotherSerial($serialno[0]);
			$LogMother->setChildPartNo($childmodel[$i]->getModel());
			$LogMother->setStage($station[0]);
			$LogMother->setStatus('GOOD');
			$LogMother->setLastUpdatedBy($name);
			$LogMother->setCurrquantity('6');
			$LogMother->setDisquantity(0);
			$LogMother->setRemarks('Link');
			$LogMother->addLogMother();
		}

echo 'success1_'.$serialno[0].'_'.$Serial->getCurrQuantity().'_'.$total1.'_'.$total2;
}else{


$childmodel = Model::SelectChildModel($account,$model);

for($i=0;$i<count($childmodel);$i++){

		$Mother = new Mother();
			$Mother->setAccount($account);
			$Mother->setCardNo($serialno[0]);
			$Mother->setStatus('GOOD');
			$Mother->setCurtstation($station[0]);
			$Mother->setLastUpdatedBy($name);
			$Mother->updateStatus();

			$LogMother = new LogMother();
			$LogMother->setAccount($account);
			$LogMother->setLine($line);
			$LogMother->setMotherSerial($serialno[0]);
			$LogMother->setChildPartNo($childmodel[$i]->getModel());
			$LogMother->setStage($station[0]);
			$LogMother->setStatus('GOOD');
			$LogMother->setLastUpdatedBy($name);
			$LogMother->setCurrquantity('6');
			$LogMother->setDisquantity(0);
			$LogMother->setRemarks('Link');
			$LogMother->addLogMother();
		}

$link = new Link2();
	$link->setAccount($account);
	$link->setSerialNo($serialno[0]);
	$link->setSerialNoLink($pt1[0]);
	$link->setPartNo($model);
	$link->setPartNoLink('Wall Charger - PT');
	$link->setQty($Serial->getCurrQuantity());
	$link->setStation($station[0]);
	$link->setDescription($description);
	$link->setLastUpdatedBy($name);
	$link->addLogLink();

	$link1 = new Link2();
	$link1->setAccount($account);
	$link1->setSerialNo($serialno[0]);
	$link1->setSerialNoLink($pt2[0]);
	$link1->setPartNo($model);
	$link1->setPartNoLink('Wall Charger - PB');
	$link1->setQty($Serial->getCurrQuantity());
	$link1->setStation($station[0]);
	$link1->setDescription($description);
	$link1->setLastUpdatedBy($name);
	$link1->addLogLink();

	echo 'insert0_'.$serialno[0].'_'.$Serial->getCurrQuantity().'_'.$total1.'_'.$total2;
}
	}
}else{
	echo 'Offroute! '.$serialno[0];
	return;
	}

		}
}else{
	echo 'Wrong Model! '.$serialno[0];
	return;
	}

	}else{
echo 'notexist_'.$serialno[0];
}



	///////////////////////else/////////////////////////
}else{

	if($model == $Serial->getPartNo()){

	if($Serial->getStatus() == 'REJECT'){

				echo 'Serial is Reject! '.$serialno[0];
				return;
			}else{

if($stage[0] == $station[0]){

if($validserialformat1=='false'){
	echo 'Incorrect Format! Serial: '.$serialno[0];
	return;
}else{

	if($countserial==0){
	echo 'Mother Serial is Empty! '.$serialno[0];
	return;
}else{
	echo 'success_'.$serialno[0].'_'.$countserial;
}
	}
}else{
	echo 'Offroute! '.$serialno[0];
	return;
	}

		}
}else{
	echo 'Wrong Model! '.$serialno[0];
	return;
	}

}

?>