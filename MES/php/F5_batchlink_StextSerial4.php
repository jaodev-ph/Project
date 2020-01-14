<?php
include_once("../classes/card.php");
include_once("../classes/batch.php");
include_once("../classes/ModelRoute.php");
include_once("../classes/serialformat.php");
include_once("../classes/logpass.php");
include_once("../classes/station.php");
include_once("../classes/repair.php");
include_once("../classes/linking.php");
session_start();

$account = $_SESSION['account'];
$name = $_SESSION['name'];
$serialno1 = $_GET['serialno1'];
$serialno2 = $_GET['serialno2'];
$serialno4 = $_GET['serialno4'];
$station = $_GET['station'];
$model = $_GET['model'];

$validserialformat4 = SerialFormat::validserialformat($account,$serialno4,'Wall Charger');
if($validserialformat4=='false'){
	echo 'Incorrect Format! Serial: '.$serialno4;
	return;
}

$exist = Card::checkExist($account,$serialno4);
if($exist=='true'){
	echo 'Serial already Exist! '.$serialno4;
	return;
}

$qty1 = Batch::getRemainingBatch($account,$serialno1);
if($qty1==0){
	echo 'PT Top already depleted!: '.$serialno1;
	return;
}
$qty2 = Batch::getRemainingBatch($account,$serialno2);
if($qty2==0){
	echo 'PT Bot already depleted!: '.$serialno2;
	return;
}


$mothercurtstation = Batch::getBatchCurtStation($account,$serialno1);


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

$Card = new Card();
$Card->setAccount($account);
$Card->setCardNo($serialno4);
$Card->setSerialNo($serialno4);
$Card->setSystem21('');
$Card->setWorkorder('');
$Card->setPartNo('Wall Charger');
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
$Card->setCurtStage('012');
$Card->setLotType('');
$Card->setLastUpdatedBy($name);
$Card->addCard();

	$link = new Link2();
	$link->setAccount($account);
	$link->setSerialNo($serialno1);
	$link->setSerialNoLink($serialno4);
	$link->setPartNo('Wall Charger - PT');
	$link->setPartNoLink('Wall Charger');
	$link->setQty(1);
	$link->setStation('012');
	$link->setDescription('Mechanical Assy');
	$link->setLastUpdatedBy($name);
	$link->addLogLink();

	$link = new Link2();
	$link->setAccount($account);
	$link->setSerialNo($serialno2);
	$link->setSerialNoLink($serialno4);
	$link->setPartNo('Wall Charger - PB');
	$link->setPartNoLink('Wall Charger');
	$link->setQty(1);
	$link->setStation('012');
	$link->setDescription('Mechanical Assy');
	$link->setLastUpdatedBy($name);
	$link->addLogLink();

	$resultqty1 = Batch::getRemainingBatch($account,$serialno1);
$resultqty2 = Batch::getRemainingBatch($account,$serialno2);

	echo 'success_'.$serialno1.'_'.$resultqty1.'_'.$serialno2.'_'.$resultqty2;
return;

?>