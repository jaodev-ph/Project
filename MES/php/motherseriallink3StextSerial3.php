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
$serial2 = $_GET['serialno2'];
$motherserial = $_GET['serialno4'];
$qty1 = $_GET['qty1'];
$qty2 = $_GET['qty2'];
$a = 0;
$b = 0;

$exist1 = Batch::checkExist($account,$serial1);
$exist2 = Batch::checkExist($account,$serial2);
$exist = Mother::checkExist($account,$motherserial);
$qty4 = Mother::getRemainingMother($account,$motherserial);
$validserialformat1 = SerialFormat::validserialformat($account,$serial1,'H599ITR');
$validserialformat2 = SerialFormat::validserialformat($account,$serial2,'H599ITLB');
if($exist=='false'){
	echo 'Mother Serial does not Exist!'.$motherserial;
	return;
}

if($qty4==0){
	echo 'Mother Serial depleted!'.$motherserial;
	return;
}

if(($qty1 == 0)&&($exist1=='false')&&($validserialformat1=='true')){
	//register serial1
	$b='b';
	$Batch = new Batch();
	$Batch->setAccount($account);
	$Batch->setCardNo($serial1);
	$Batch->setBatchno($serial1);
	$Batch->setWorkorder('');
	$Batch->setPartNo('H599ITR');
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
if(($qty2 == 0)&&($exist2=='false')&&($validserialformat2=='true')){
	//register serial2
	$Batch = new Batch();
	$Batch->setAccount($account);
	$Batch->setCardNo($serial2);
	$Batch->setBatchno($serial2);
	$Batch->setWorkorder('');
	$Batch->setPartNo('H599ITLB');
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
$a = '1';
	//check maxqty of partno in linkmaintenance
	$maxqty1 = Link2::getMaxQtyofModel($account,$partno1);
	//check resultqty=motherqty1 + childqty1
	$totalqty1 = intval($motherqty1) + intval($childqty1);

	$Card->setAccount($account);
	$Card->setBatchNo($serial1);
	$Card->setCardNo($serial1);
	$Card->setLastUpdatedBy($name);

	if($totalqty1>=$maxqty1){
		$a='2';
		$resultqty1 = $maxqty1;
		$diffqty1 = intval($maxqty1) - intval($childqty1);
		$resultlinkedqty1 = intval($motherlinkedqty1) + intval($diffqty1);
		$loglinkqty = intval($maxqty1) - intval($childqty1);
		
		$Card->setStatus('GOOD');
		$Card->updateStatus3();
	}else{
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
	$LogBatch = new LogBatch();
	$LogBatch->setAccount($account);
	$LogBatch->setLine($line);
	$LogBatch->setBatchno($serial1);
	$LogBatch->setCurtstage($station);
	$LogBatch->setStatus('GOOD');
	$LogBatch->setLastUpdatedBy($name);
	$LogBatch->setCurrquantity($loglinkqty);
	$LogBatch->setDisquantity(0);
	$LogBatch->addLogbatch();
}
//end

//start serial2
//check partno of serial2
$Card = new Batch($account,$serial2);
$partno2 = $Card->getPartno();

//check currqty - linkqty of childpartno in motherserial
$motherqty2 = Mother::getCountChildPartno($account,$motherserial,$partno2);
$mothercurrqty2 = Mother::getCurrQtyChildPartno($account,$motherserial,$partno2);
$motherlinkedqty2 = Mother::getLinkedQtyChildPartno($account,$motherserial,$partno2);
$childqty2 = Batch::getBatchQty($account,$serial2);
$resultqty2 = $childqty2;

if($motherqty2>0){	

	//check maxqty of partno in linkmaintenance
	$maxqty2 = Link2::getMaxQtyofModel($account,$partno2);
	//check resultqty=motherqty2 + childqty2
	$totalqty2 = intval($motherqty2) + intval($childqty2);

	$Card->setAccount($account);
	$Card->setBatchno($serial2);
	$Card->setCardNo($serial2);
	$Card->setLastUpdatedBy($name);


	if($totalqty2>=$maxqty2){
		$resultqty2 = $maxqty2;
		$diffqty2 = intval($maxqty2) - intval($childqty2);
		$resultlinkedqty2 = intval($motherlinkedqty2) + intval($diffqty2);
		$loglinkqty = intval($maxqty2) - intval($childqty2);
		
		$Card->setStatus('GOOD');
		$Card->updateStatus3();
	}else{
		$resultlinkedqty2 = $mothercurrqty2;
		$resultqty2 = $totalqty2;
		$loglinkqty = intval($mothercurrqty2) - intval($motherlinkedqty2);
	}
// //update serial2
	Mother::updateLinkedQty($account,$motherserial,$partno2,$resultlinkedqty2,$name);
	$Card->setCurrquantity($resultqty2);
	$Card->updateBothQty();
//loglink serial2
	$link = new Link2();
	$link->setAccount($account);
	$link->setSerialNo($motherserial);
	$link->setSerialNoLink($serial2);
	$link->setPartNo($model);
	$link->setPartNoLink($partno2);
	$link->setQty($loglinkqty);
	$link->setStation($station);
	$link->setDescription($description);
	$link->setLastUpdatedBy($name);
	$link->addLogLink();

//logbatch serial1
	$LogBatch = new LogBatch();
	$LogBatch->setAccount($account);
	$LogBatch->setLine($line);
	$LogBatch->setBatchno($serial2);
	$LogBatch->setCurtstage($station);
	$LogBatch->setStatus('GOOD');
	$LogBatch->setLastUpdatedBy($name);
	$LogBatch->setCurrquantity($loglinkqty);
	$LogBatch->setDisquantity(0);
	$LogBatch->addLogbatch();
}

$qty4 = Mother::getRemainingMother($account,$motherserial);

echo 'success_'.$serial1.'_'.$resultqty1.'_'.$serial2.'_'.$resultqty2.'_'.$motherserial.'_'.$qty4.'_'.$partno1.'motherqty1:_'.$motherqty1;
return;



?>