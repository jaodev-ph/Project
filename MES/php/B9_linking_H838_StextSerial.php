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
$serialno = $_GET['serialno'];
$model = $_GET['model'];
$sequence = $_GET['sequence'];


$fullstation = $_GET['station'];
$splitstation = explode(":", $fullstation);
$station = $splitstation[0];

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
if($checkexist=='true'){$boolcheckexist=true;}
else{$boolcheckexist=false;}


$validserialformat1 = SerialFormat::validserialformat($account,$serialno,$dbmodel);
if($validserialformat1=='false'){
	echo 'Incorrect Format! Serial: '.$serialno;
	return;
}

if($boolcheckexist<>$isReg){
	if($checkexist=='false'){
	echo 'No Serial Found: '.$serialno;
	return;
	}
	if($checkexist=='true'){
	echo 'Serial already exist: '.$serialno;
	return;
	}
}

if($dbpartno<>$dbmodel){
	echo 'Wrong Model: '.$serialno;
	return;
}

if($dbstatus<>$linkstatus){
	echo 'Incorrect Status: '.$serialno.' is '.$dbstatus;
	return;
}

$ModelRoute = new ModelRoute();
$ModelRoute->setAccount($account);
$ModelRoute->setStation($dbcurtstation);
$ModelRoute->getStationDetails();
$curr = $ModelRoute->getFlowsequence();
$ModelRoute->setAccount($account);
$ModelRoute->setStation($station);
$ModelRoute->getStationDetails();
$next = $ModelRoute->getFlowsequence();

$isvalidnextstage = ModelRoute::isvalidnextstage2($account,$model, $curr, $next);

if($isvalidnextstage=='false'){
	echo 'Offroute! Serial: '.$serialno;
	return;
}


 $qty = Link2::linkedqty($account,$serialno,$station);
if(($qty==$dbmaxqty)&&($dbreduceqty)){
	echo 'Max Linked Qty reached! Serial: '.$serialno;
	return;
}

	echo 'success_'.$serialno.'_'.$qty;

	

?>