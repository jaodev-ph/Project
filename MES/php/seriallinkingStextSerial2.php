<?php
include_once("../classes/card.php");
/*include_once("../classes/serialformat.php");
include_once("../classes/modelRoute.php");*/
include_once("../classes/station.php");
include_once("../classes/logpass.php");
include_once("../classes/batch.php");
include_once("../classes/linking.php");
session_start();

// transfer values from html

$account = trim($_SESSION['account']);
$name = $_SESSION['name'];
$serial1 = explode(" ",$_GET['serial1']);
$serial2 = explode(" ",$_GET['serial2']);
$fullmodel = $_GET['model'];
$model = explode(" ",$_GET['model']);
$line = $_GET['line'];
$type = 'N';
$station = $_GET['station'];

//end transfer values from html


//serial checking if already exist
// $serialarr2 = sizeof($serial2);
// if($serialarr2<2){
// 	echo 'error1_'.$serial2[0];
// 	return;	
// }
// 	$linecode = $serial2[1];
//end serial checking if already exist




//serial checking if already exist
$exist = Card::checkExist($account,$serial2[0]);
if($exist == 'true'){
	echo 'error1_'.$serial2[0];
	return;
}
//end serial checking if already exist


//serial format checking
$checkSerialFormat = Link2::serialformat($account,$fullmodel,$serial2[0]);
if($checkSerialFormat == 'false'){
	echo 'error2_'.$serial2[0];
	return;
}
//end serial format checking

$link = new Link2();

$link->batchqty($serial1[0]);
$batchqty = $link->getQty();

$Batch = new Batch($account,$serial1[0]);
$dbmodel = $Batch->getPartNo();
$dbstation = $Batch->getCurtStage();
$dbstatus = $Batch->getStatus();

$link->linkinfo($fullmodel,$station);
$linkstatus = $link->getStatus();
$linkqty = $link->getQty();

if($batchqty>$linkqty){
	$resultqty = $linkqty;
	$diff = $batchqty - $linkqty;	
}else{
	$resultqty = $batchqty;
	$diff = 0;
}


$Station = new Station();
$Station->StationDetails($account,$station);
$description = $Station->getDescription();





// if($kanbanstatus<>$linkstatus){
// 	echo 'error3_'.$_GET['did'].'_'.$resultqty;
// 	return;
// }

// if($pwbqty <= 0){
// 	echo 'error4_'.$_GET['did'].'_'.$resultqty;
// 	return;
// }

$Card = new Card();
$Card->setAccount($account);
$Card->setCardNo($serial2[0]);
$Card->setSerialNo($serial2[0]);
$Card->setSystem21('');
$Card->setWorkorder('');
$Card->setPartNo($fullmodel);
$Card->setRevision($model[1]);
$Card->setLineCode('');
$Card->setHoldFlag(0);
$Card->setPackFlag(0);
$Card->setShipFlag(0);
$Card->setRTVFlag(0);
$Card->setRejectFlag(0);
$Card->setStatus('GOOD');
$Card->setLotno('');
$Card->setLotType('N');
$Card->setCurtStage($station);
$Card->setLastUpdatedBy($name);
$Card->addCard();

$Logpass = new LogPass();
$Logpass->setAccount($account);
$Logpass->setCardNo($serial2[0]);
$Logpass->setLine($line);
$Logpass->setSequence(0);
$Logpass->setMachine('');
$Logpass->setStation($station);
$Logpass->setStatus('GOOD');
$Logpass->setLastUpdatedBy($name);
$Logpass->addLogpass();

// $LogBatch = new LogBatch();
// $LogBatch->setAccount($account);
// $LogBatch->setLine($line);
// $LogBatch->setBatchno($serialno[0]);

// $LogBatch->setCurtstage($station);
// $LogBatch->setStatus('GOOD');
// $LogBatch->setLastUpdatedBy($name);
// $LogBatch->setCurrquantity($resultqty);
// $LogBatch->setDisquantity(0);
// $LogBatch->addLogbatch();


$link->setAccount($account);
$link->setSerialNo($serial1[0]);
$link->setSerialNoLink($serial2[0]);
$link->setPartNo($dbmodel);
$link->setPartNoLink($fullmodel);
$link->setQty($resultqty);
$link->setStation($station);
$link->setDescription($description);
$link->setLastUpdatedBy($name);
$link->addLogLink();


// $link->updateDIDqty($did[0],$name,$account,$diff);

echo 'success_'.$serial2[0].'_'.$model[0].'_'.$station.'_'.$name.'_'.$diff.'_'.strlen($serial2[0]);
//."_".$line."_"."GOOD"."_".$name."_".$diff;












?>