<?php
//include_once("../classes/card.php");
/*include_once("../classes/serialformat.php");
include_once("../classes/logpass.php");
include_once("../classes/station.php");
include_once("../classes/modelRoute.php");*/
include_once("../classes/logbatch.php");
include_once("../classes/batch.php");
include_once("../classes/linking.php");
session_start();


$account = trim($_SESSION['account']);
$name = $_SESSION['name'];
$did = explode(" ",$_GET['did']);
$serialno = explode(" ",$_GET['serialno']);
$fullmodel = $_GET['model'];
$modelno = explode(" ",$fullmodel);
$line = $_GET['line'];
$type = 'N';
$fullstation = $_GET['station'];
$station = explode(":",$fullstation);




$exist = Batch::checkExist($account,$serialno[0]);

$link = new Link2();

$link->pwbqty($did[0]);
$pwbqty = $link->getQty();

$link->pwblot($did[0]);
$kanbanstatus = $link->getStatus();
$kanbanPN = $link->getPartno();

$link->linkinfo($fullmodel,$station[0]);
$linkstatus = $link->getStatus();
$linkqty = $link->getQty();

if($pwbqty>$linkqty){
	$resultqty = $linkqty;
	$diff = $pwbqty - $linkqty;	
}else{
	$resultqty = $pwbqty;
	$diff = 0;
}





if($exist == 'true'){
	echo 'error1_'.$serialno[0];
	return;
}

if($kanbanstatus<>$linkstatus){
	echo 'error3_'.$_GET['did'].'_'.$resultqty;
	return;
}

if($pwbqty <= 0){
	echo 'error4_'.$_GET['did'].'_'.$resultqty;
	return;
}
$Batch = new Batch();
$Batch->setAccount($account);
$Batch->setCardNo($serialno[0]);
$Batch->setBatchno($serialno[0]);

$Batch->setWorkorder('');
$Batch->setPartNo($fullmodel);
$Batch->setRevision($modelno[1]);
$Batch->setLineCode($line);
$Batch->setRefno('');
$Batch->setHoldFlag(0);
$Batch->setPackFlag(0);
$Batch->setShipFlag(0);
$Batch->setRTVFlag(0);
$Batch->setRejectFlag(0);
$Batch->setStatus('GOOD');
$Batch->setLotno('');
$Batch->setLotType('N');
$Batch->setCurtStage($station[0]);
$Batch->setLotType($type);
$Batch->setLastUpdatedBy($name);
$Batch->setParentbatchno('');
$Batch->setChildbatchno('');
$Batch->setOrigquantity($resultqty);
$Batch->setCurrquantity($resultqty);
$Batch->addBatch();

$LogBatch = new LogBatch();
$LogBatch->setAccount($account);
$LogBatch->setLine($line);
$LogBatch->setBatchno($serialno[0]);
$LogBatch->setCurtstage($station[0]);
$LogBatch->setStatus('GOOD');
$LogBatch->setLastUpdatedBy($name);
$LogBatch->setCurrquantity($resultqty);
$LogBatch->setDisquantity(0);
$LogBatch->addLogbatch();


$link->setAccount($account);
$link->setSerialNo($did[0]);
$link->setSerialNoLink($serialno[0]);
$link->setPartNo($kanbanPN);
$link->setPartNoLink($fullmodel);
$link->setQty($resultqty);
$link->setStation($station[0]);
$link->setDescription('SPA');
$link->setLastUpdatedBy($name);
$link->addLogLink();

echo 'success_'.$modelno[0]."_".$line."_"."GOOD"."_".$name."_".$diff;
?>