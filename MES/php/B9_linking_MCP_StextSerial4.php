<?php
include_once("../classes/card.php");
include_once("../classes/batch.php");
include_once("../classes/serialformat.php");
include_once("../classes/logbatch.php");
include_once("../classes/logpass.php");
include_once("../classes/station.php");
include_once("../classes/repair.php");
include_once("../classes/mother.php");
include_once("../classes/linking.php");
include_once("../classes/modelroute.php");
session_start();

$account = trim($_SESSION['account']);
$name = trim($_SESSION['name']);
$model = $_GET['model'];
$fullstation = $_GET['station'];
$splitstation = explode(":", $fullstation);
$station = $splitstation[0];
$description = trim($splitstation[1]);
$line = $_GET['line'];
$serial1 = $_GET['serialno1'];
// $serial2 = $_GET['serialno2'];
// $serial3 = $_GET['serialno3'];
$motherserial = $_GET['serialno4'];
$qty1 = $_GET['qty1'];
// $qty2 = $_GET['qty2'];
// $qty3 = $_GET['qty3'];






$exist = Mother::checkExist($account,$motherserial);
$qty4 = Mother::getRemainingMother($account,$motherserial);
$mothercurtstation = Mother::getMotherCurtStation($account,$motherserial);

$ModelRoute = new ModelRoute();
$ModelRoute->setAccount($account);
$ModelRoute->setStation($mothercurtstation);
$ModelRoute->getStationDetails();
$curr = $ModelRoute->getFlowsequence();
$ModelRoute->setAccount($account);
$ModelRoute->setStation($station);
$ModelRoute->getStationDetails();
$next = $ModelRoute->getFlowsequence();

$isvalidnextstage = ModelRoute::isvalidnextstage2($account,$model, $curr, $next);

if($exist=='false'){
	echo 'Mother Serial does not Exist! '.$motherserial;
	return;
}

if($isvalidnextstage=='false'){
	echo 'Offroute! Serial: '.$motherserial;
	return;
}

if($qty4==0){
	echo 'Mother Serial depleted! '.$motherserial;
	return;
}

if($qty1 == 0){
	//register serial1
	$Batch = new Batch();
	$Batch->setAccount($account);
	$Batch->setCardNo($serial1);
	$Batch->setBatchno($serial1);
	$Batch->setWorkorder('');
	$Batch->setPartNo('H990MCP');
	$Batch->setRevision('');
	$Batch->setLineCode($line);
	$Batch->setRefno('');
	$Batch->setHoldFlag(0);
	$Batch->setPackFlag(0);
	$Batch->setShipFlag(0);
	$Batch->setRTVFlag(0);
	$Batch->setRejectFlag(0);
	$Batch->setStatus('NC');
	$Batch->setLotno('');
	$Batch->setLotType('');
	$Batch->setCurtStage($station);
	$Batch->setLotType('N');
	$Batch->setLastUpdatedBy($name);
	$Batch->setParentbatchno($motherserial);
	$Batch->setChildbatchno('');
	$Batch->setOrigquantity(0);
	$Batch->setCurrquantity(0);
	$Batch->addBatch();
}
// if($qty2 == 0){
// 	//register serial2
// 	$Batch = new Batch();
// 	$Batch->setAccount($account);
// 	$Batch->setCardNo($serial2);
// 	$Batch->setBatchno($serial2);
// 	$Batch->setWorkorder('');
// 	$Batch->setPartNo('H740PENB');
// 	$Batch->setRevision('');
// 	$Batch->setLineCode($line);
// 	$Batch->setRefno('');
// 	$Batch->setHoldFlag(0);
// 	$Batch->setPackFlag(0);
// 	$Batch->setShipFlag(0);
// 	$Batch->setRTVFlag(0);
// 	$Batch->setRejectFlag(0);
// 	$Batch->setStatus('NC');
// 	$Batch->setLotno('');
// 	$Batch->setLotType('');
// 	$Batch->setCurtStage($station);
// 	$Batch->setLotType('N');
// 	$Batch->setLastUpdatedBy($name);
// 	$Batch->setParentbatchno($motherserial);
// 	$Batch->setChildbatchno('');
// 	$Batch->setOrigquantity(0);
// 	$Batch->setCurrquantity(0);
// 	$Batch->addBatch();
// }
// if($qty3 == 0){
// 	//register serial2
// 	$Batch = new Batch();
// 	$Batch->setAccount($account);
// 	$Batch->setCardNo($serial3);
// 	$Batch->setBatchno($serial3);
// 	$Batch->setWorkorder('');
// 	$Batch->setPartNo('H740TIPA');
// 	$Batch->setRevision('');
// 	$Batch->setLineCode($line);
// 	$Batch->setRefno('');
// 	$Batch->setHoldFlag(0);
// 	$Batch->setPackFlag(0);
// 	$Batch->setShipFlag(0);
// 	$Batch->setRTVFlag(0);
// 	$Batch->setRejectFlag(0);
// 	$Batch->setStatus('NC');
// 	$Batch->setLotno('');
// 	$Batch->setLotType('');
// 	$Batch->setCurtStage($station);
// 	$Batch->setLotType('N');
// 	$Batch->setLastUpdatedBy($name);
// 	$Batch->setParentbatchno($motherserial);
// 	$Batch->setChildbatchno('');
// 	$Batch->setOrigquantity(0);
// 	$Batch->setCurrquantity(0);
// 	$Batch->addBatch();
// }

//start serial1
//check partno of serial1
$Card = new Batch($account,$serial1);
$partno1 = $Card->getPartno();

//check currqty - linkqty of childpartno in motherserial
$motherqty1 = Mother::getCountChildPartno($account,$motherserial,$partno1);
$mothercurrqty1 = Mother::getCurrQtyChildPartno($account,$motherserial,$partno1);
$motherlinkedqty1 = Mother::getLinkedQtyChildPartno($account,$motherserial,$partno1);
$childqty1 = Batch::getBatchQty($account,$serial1);
$resultqty1 = $childqty1;

if($motherqty1>0){	

	//check maxqty of partno in linkmaintenance
	$maxqty1 = Link2::getMaxQtyofModel($account,$partno1);
	//check resultqty=motherqty1 + childqty1
	$totalqty1 = intval($motherqty1) + intval($childqty1);

	$Card->setAccount($account);
	$Card->setCardNo($serial1);
	$Card->setLastUpdatedBy($name);

	if($totalqty1>=$maxqty1){
		$a = 1;
		$resultqty1 = $maxqty1;
		$diffqty1 = intval($maxqty1) - intval($childqty1);
		$resultlinkedqty1 = intval($motherlinkedqty1) + intval($diffqty1);
		$loglinkqty = intval($maxqty1) - intval($childqty1);
		
		$Card->setStatus('GOOD');
		$Card->updateStatus3();
	}else{
		$a = 2;
		$resultlinkedqty1 = $mothercurrqty1;
		$resultqty1 = $totalqty1;
		$loglinkqty = intval($mothercurrqty1) - intval($motherlinkedqty1);
	}
// //update serial1
	Mother::updateLinkedQty($account,$motherserial,$partno1,$resultlinkedqty1,$name);
	$Card->setCurrquantity($resultqty1);
	$Card->updateBothQty();
//loglink serial1
	$link = new Link2();
	$link->setAccount($account);
	$link->setSerialNo($motherserial);
	$link->setSerialNoLink($serial1);
	$link->setPartNo($model);
	$link->setPartNoLink($partno1);
	$link->setQty($loglinkqty);
	$link->setStation($station);
	$link->setDescription($description);
	$link->setLastUpdatedBy($name);
	$link->addLogLink();

//logbatch serial1
	if($resultqty1==$maxqty1){
	$LogBatch = new LogBatch();
	$LogBatch->setAccount($account);
	$LogBatch->setLine($line);
	$LogBatch->setBatchno($serial1);
	$LogBatch->setCurtstage($station);
	$LogBatch->setStatus('GOOD');
	$LogBatch->setLastUpdatedBy($name);
	$LogBatch->setCurrquantity($resultqty1);
	$LogBatch->setDisquantity(0);
	$LogBatch->addLogbatch();
	}
}
//end

//start serial2
//check partno of serial2
// $Card = new Batch($account,$serial2);
// $partno2 = $Card->getPartno();

// //check currqty - linkqty of childpartno in motherserial
// $motherqty2 = Mother::getCountChildPartno($account,$motherserial,$partno2);
// $mothercurrqty2 = Mother::getCurrQtyChildPartno($account,$motherserial,$partno2);
// $motherlinkedqty2 = Mother::getLinkedQtyChildPartno($account,$motherserial,$partno2);
// $childqty2 = Batch::getBatchQty($account,$serial2);
// $resultqty2 = $childqty2;

// if($motherqty2>0){	

// 	//check maxqty of partno in linkmaintenance
// 	$maxqty2 = Link2::getMaxQtyofModel($account,$partno2);
// 	//check resultqty=motherqty2 + childqty2
// 	$totalqty2 = intval($motherqty2) + intval($childqty2);

// 	$Card->setAccount($account);
// 	$Card->setCardNo($serial2);
// 	$Card->setLastUpdatedBy($name);


// 	if($totalqty2>=$maxqty2){
// 		$resultqty2 = $maxqty2;
// 		$diffqty2 = intval($maxqty2) - intval($childqty2);
// 		$resultlinkedqty2 = intval($motherlinkedqty2) + intval($diffqty2);
// 		$loglinkqty = intval($maxqty2) - intval($childqty2);
		
// 		$Card->setStatus('GOOD');
// 		$Card->updateStatus3();
// 	}else{
// 		$resultlinkedqty2 = $mothercurrqty2;
// 		$resultqty2 = $totalqty2;
// 		$loglinkqty = intval($mothercurrqty2) - intval($motherlinkedqty2);
// 	}
// // //update serial2
// 	Mother::updateLinkedQty($account,$motherserial,$partno2,$resultlinkedqty2,$name);
// 	$Card->setCurrquantity($resultqty2);
// 	$Card->updateBothQty();
// //loglink serial2
// 	$link = new Link2();
// 	$link->setAccount($account);
// 	$link->setSerialNo($motherserial);
// 	$link->setSerialNoLink($serial2);
// 	$link->setPartNo($model);
// 	$link->setPartNoLink($partno2);
// 	$link->setQty($loglinkqty);
// 	$link->setStation($station);
// 	$link->setDescription($description);
// 	$link->setLastUpdatedBy($name);
// 	$link->addLogLink();

// //logbatch serial2
// 	if($resultqty2==$maxqty2){
// 	$LogBatch = new LogBatch();
// 	$LogBatch->setAccount($account);
// 	$LogBatch->setLine($line);
// 	$LogBatch->setBatchno($serial2);
// 	$LogBatch->setCurtstage($station);
// 	$LogBatch->setStatus('GOOD');
// 	$LogBatch->setLastUpdatedBy($name);
// 	$LogBatch->setCurrquantity($resultqty2);
// 	$LogBatch->setDisquantity(0);
// 	$LogBatch->addLogbatch();
// 	}
// }

// //start serial3
// //check partno of serial3
// $Card = new Batch($account,$serial3);
// $partno3 = $Card->getPartno();

// //check currqty - linkqty of childpartno in motherserial
// $motherqty3 = Mother::getCountChildPartno($account,$motherserial,$partno3);
// $mothercurrqty3 = Mother::getCurrQtyChildPartno($account,$motherserial,$partno3);
// $motherlinkedqty3 = Mother::getLinkedQtyChildPartno($account,$motherserial,$partno3);
// $childqty3 = Batch::getBatchQty($account,$serial3);
// $resultqty3 = $childqty3;

// if($motherqty3>0){		
// 	//check maxqty of partno in linkmaintenance
// 	$maxqty3 = Link2::getMaxQtyofModel($account,$partno3);
// 	//check resultqty=motherqty3 + childqty3
// 	$totalqty3 = intval($motherqty3) + intval($childqty3);

// 	$Card->setAccount($account);
// 	$Card->setCardNo($serial3);
// 	$Card->setLastUpdatedBy($name);

// 	if($totalqty3>=$maxqty3){
// 		$resultqty3 = $maxqty3;
// 		$diffqty3 = intval($maxqty3) - intval($childqty3);
// 		$resultlinkedqty3 = intval($motherlinkedqty3) + intval($diffqty3);
// 		$loglinkqty = intval($maxqty3) - intval($childqty3);
		
// 		$Card->setStatus('GOOD');
// 		$Card->updateStatus3();
// 	}else{
// 		$resultlinkedqty3 = $mothercurrqty3;
// 		$resultqty3 = $totalqty3;
// 		$loglinkqty = intval($mothercurrqty3) - intval($motherlinkedqty3);
// 	}
// // //update serial3
// 	Mother::updateLinkedQty($account,$motherserial,$partno3,$resultlinkedqty3,$name);
// 	$Card->setCurrquantity($resultqty3);
// 	$Card->updateBothQty();
// //loglink serial3
// 	$link = new Link2();
// 	$link->setAccount($account);
// 	$link->setSerialNo($motherserial);
// 	$link->setSerialNoLink($serial3);
// 	$link->setPartNo($model);
// 	$link->setPartNoLink($partno3);
// 	$link->setQty($loglinkqty);
// 	$link->setStation($station);
// 	$link->setDescription($description);
// 	$link->setLastUpdatedBy($name);
// 	$link->addLogLink();

// //logbatch serial3
// 	if($resultqty3==$maxqty3){
// 	$LogBatch = new LogBatch();
// 	$LogBatch->setAccount($account);
// 	$LogBatch->setLine($line);
// 	$LogBatch->setBatchno($serial3);
// 	$LogBatch->setCurtstage($station);
// 	$LogBatch->setStatus('GOOD');
// 	$LogBatch->setLastUpdatedBy($name);
// 	$LogBatch->setCurrquantity($resultqty3);
// 	$LogBatch->setDisquantity(0);
// 	$LogBatch->addLogbatch();
// 	}
//}

$qty4 = Mother::getRemainingMother($account,$motherserial);

echo 'success_'.$serial1.'_'.$resultqty1.'_'.$qty4.'_'.$motherserial.'_'.$motherqty1;
return;



?>