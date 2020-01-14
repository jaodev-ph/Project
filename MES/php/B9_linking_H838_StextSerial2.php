<?php
include_once("../classes/card.php");
include_once("../classes/batch.php");
include_once("../classes/serialformat.php");
include_once("../classes/linking.php");
include_once("../classes/logpass.php");
include_once("../classes/station.php");
include_once("../classes/repair.php");
include_once("../classes/ModelRoute.php");
session_start();

$account = $_SESSION['account'];
$name = trim($_SESSION['name']);
$serialno = $_GET['serialno'];
$serialno2 = $_GET['serialno2'];
$model = $_GET['model'];
$sequence = $_GET['sequence'];
$line = $_GET['line'];


$fullstation = $_GET['station'];
$splitstation = explode(":", $fullstation);
$station = $splitstation[0];
$description = $splitstation[1];

$Card = new Card($account,$serialno);
$checkexist = Card::checkexist($account,$serialno);
$dbserialno = $Card->getCardNo();
$dbpartno = $Card->getPartNo();
$dbstatus = $Card->getStatus();
$dbcurtstation = $Card->getCurtStage();

$Link = new Link2();
$Link->linkinfowithseq($model,$station,$sequence);
$dbmodel = $Link->getPartno();
$dbmaxqty = $Link->getQty();
$linkstatus = $Link->getStatus();
$dbreduceqty = $Link->getReduceqty();
$isReg = $Link->getIsReg();

$validserialformat1 = SerialFormat::validserialformat($account,$serialno2,$dbmodel);
if($validserialformat1=='false'){
	echo 'Incorrect Format! Serial: '.$serialno2;
	return;
}

if($checkexist<>$isReg){
	if($checkexist=='false'){
		echo 'No Serial Found: '.$serialno2;
		return;
	}
	if($checkexist=='true'){
		echo 'Serial already exist: '.$serialno2.$checkexist.boolval($isReg);
		return;
	}
}


// if($dbpartno<>$dbmodel){
// 	echo 'Wrong Model: '.$serialno;
// 	return;
// }

// if($dbstatus<>$linkstatus){
// 	echo 'Incorrect status: '.$serialno.' is '.$dbstatus;
// 	return;
// }

// if($dbstatus<>'GOOD'){
// 	echo 'Serial '.$serialno2.' is '.$dbstatus;
// 	return;
// }

// $ModelRoute = new ModelRoute();
// $ModelRoute->setAccount($account);
// $ModelRoute->setStation($dbcurtstation);
// $ModelRoute->getStationDetails();
// $curr = $ModelRoute->getFlowsequence();
// $ModelRoute->setAccount($account);
// $ModelRoute->setStation($station);
// $ModelRoute->getStationDetails();
// $next = $ModelRoute->getFlowsequence();

// $isvalidnextstage = ModelRoute::isvalidnextstage2($account,$dbpartno, $curr, $next);

// if($isvalidnextstage=='false'){
// 	echo 'Offroute! Serial: '.$serialno;
// 	return;
// }

$Link = new Link2();
$Link->linkinfowithseq($model,$station,$sequence);
$dbmodel = $Link->getPartno();
$dbmaxqty = $Link->getQty();
$dbmodel = $Link->getPartno();
$dbreduceqty = $Link->getReduceqty();

$validserialformat1 = SerialFormat::validserialformat($account,$serialno2,$dbmodel);
if($validserialformat1=='false'){
	echo 'Incorrect Format! Serial: '.$serialno2.$model.$station.$sequence.'1';
	return;
}
$qty = Link2::linkedqty($account,$serialno,$station);
if(($qty==$dbmaxqty)&&($dbreduceqty)){
	echo 'Max Linked Qty reached! Serial: '.$serialno2;
	return;
}

////////////////////////////////////////////////////////////////////////////////////////////////////

$Card = new Card();
$Card->setAccount($account);
$Card->setCardNo($serialno2);
$Card->setSerialNo($serialno2);
$Card->setSystem21('');
$Card->setWorkorder('');
$Card->setPartNo($dbmodel);
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

$link = new Link2();
$link->setAccount($account);
$link->setSerialNo($serialno);
$link->setSerialNoLink($serialno2);
$link->setPartNo($model);
$link->setPartNoLink($dbmodel);
$link->setQty('1');
$link->setStation($station);
$link->setDescription($description);
$link->setLastUpdatedBy($name);
$link->addLogLink2();

$Card = new Card();
			$Card->setAccount($account);
			$Card->setCardNo($serialno);
			$Card->setStatus('GOOD');
			$Card->setCurtStage($station);
			$Card->setLastUpdatedBy($name);
			$Card->updateStatus();

$Logpass = new LogPass();
			$Logpass->setAccount($account);
			$Logpass->setLine($line);
			$Logpass->setCardNo($serialno2);
			$Logpass->setSequence(0);
			$Logpass->setMachine('');
			$Logpass->setStation($station);
			$Logpass->setStatus('GOOD');
			$Logpass->setLastUpdatedBy($name);
			$Logpass->addLogpass();

echo 'success_'.$serialno2;



?>