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
$fullstation = $_GET['station'];
$explodestation = explode(":",$_GET['station']);
$station = $explodestation[0];
$model = $_GET['model'];

$validserialformat2 = SerialFormat::validserialformat($account,$serialno2,'Wall Charger - BS');
if($validserialformat2=='false'){
	echo 'Incorrect Format! Serial: '.$serialno2;
	return;
}

$exist = Card::checkExist($account,$serialno2);
if($exist<>'true'){
	echo 'Serial does not Exist! '.$serialno2;
	return;
}

// $qty1 = Batch::getRemainingBatch($account,$serialno1);
// if($qty1==0){
// 	echo 'PT Top already depleted!: '.$serialno1;
// 	return;
// }
// $qty2 = Batch::getRemainingBatch($account,$serialno2);
// if($qty2==0){
// 	echo 'PT Bot already depleted!: '.$serialno2;
// 	return;
// }

$qty = Link2::getcountlink2($account,$serialno2,'Wall Charger - TS');
if($qty>0){
	echo 'Serial already linked!: '.$serialno2;
	return;
}


$serialcurtstation = Card::getCardCurtStation($account,$serialno2);


$ModelRoute = new ModelRoute();
$ModelRoute->setAccount($account);
$ModelRoute->setStation($serialcurtstation);
$ModelRoute->getStationDetails();
$curr = $ModelRoute->getFlowsequence();
$ModelRoute->setAccount($account);
$ModelRoute->setStation($station);
$ModelRoute->getStationDetails();
$next = $ModelRoute->getFlowsequence();

$isvalidnextstage = ModelRoute::isvalidnextstage2($account,$model, $curr, $next);

$Card = new Card();
			$Card->setAccount($account);
			$Card->setCardNo($serialno1);
			$Card->setStatus('GOOD');
			$Card->setCurtStage($station);
			$Card->setLastUpdatedBy($name);
			$Card->updateStatus();

	$link = new Link2();
	$link->setAccount($account);
	$link->setSerialNo($serialno1);
	$link->setSerialNoLink($serialno2);
	$link->setPartNo('Wall Charger - TS');
	$link->setPartNoLink('Wall Charger - BS');
	$link->setQty(1);
	$link->setStation('012');
	$link->setDescription('Mechanical Assy');
	$link->setLastUpdatedBy($name);
	$link->addLogLink();

// 	$resultqty1 = Batch::getRemainingBatch($account,$serialno1);
// $resultqty2 = Batch::getRemainingBatch($account,$serialno2);

	echo 'success_'.$serialno1.'_'.$serialno2.'_'.$station;
return;

?>