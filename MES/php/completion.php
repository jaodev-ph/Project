<?php
include_once("../classes/card.php");
include_once("../classes/lotnumber.php");
include_once("../classes/logpass.php");
include_once("../classes/loglot.php");

session_start();

	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serialno = explode(" ",$_GET['serialno']);
	$lotno = explode(" ",$_GET['lotno']);
	$station1  = explode(":",$_GET['station']);
	$model = $_GET['model'];

	$textSerial = json_decode($_GET['textSerial']);
	$textstatus = json_decode($_GET['textStatus']);

$lot = new lotnumber($account,$lotno[0]);
$lot->setAccount($account);
$lot->setlotno($lotno[0]);
$lot->setstage($station1[0]);
$lot->setstatus('GOOD');
$lot->setlastupdatedby($name);
$lot->updateLotCompletion();

$card = new Card();
$card->setAccount($account);
$card->setlotno($lotno[0]);
$card->setCurtstage($station1[0]);
$card->setStatus('GOOD');
$card->setlastupdatedby($name);
$card->updateCompletion();

$loglot = new Loglot();
$loglot->setAccount($account);
$loglot->setLotno($lotno[0]);
$loglot->setModelno($model);
$loglot->setStation($station1[0]);
$loglot->setStatus('GOOD');
$loglot->setSamplingsize('');
$loglot->setLastUpdatedBy($name);
$loglot->addLotLogpass();

	for($i=0;$i<count($textstatus);$i++){
			$Logpass = new LogPass();
			$Logpass->setAccount($account);
			$Logpass->setLine('');
			$Logpass->setCardNo($textSerial[$i]);
			$Logpass->setSequence(0);
			$Logpass->setMachine('');
			$Logpass->setStation($station1[0]);
			$Logpass->setStatus($textstatus[$i]);
			$Logpass->setLastUpdatedBy($name);
			$Logpass->addLogpass();
		}

 echo 'success'."_".$lotno[0]."_".$model;

?> 