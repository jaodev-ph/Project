<?php
 
include_once("../classes/modelroute.php");
include_once("../classes/station.php");
include_once("../classes/model.php");
include_once("../classes/lotnumber.php");
include_once("../classes/loglot.php");
session_start();


	$account = trim($_SESSION['account']);
	$modelno = $_GET['modelno'];
	$station = explode(":",$_GET['station']);
	$LotQuantity = $_GET['LotQuantity'];
	$name = $_SESSION['name'];
	$lotno = $_GET['lotno'];

	$lotnumber = new LotNumber();
	$lotnumber->setPartno($modelno);
	$lotnumber->setAccount($account);
	$lotnumber->setLotno($lotno);
	$lotnumber->setQuantity($LotQuantity);
	$lotnumber->setStatus('completed');
	$lotnumber->setStage($station[0]);
	$lotnumber->setLastUpdatedBy($name);
	$lotnumber->updateLotStatus();

	$loglot = new Loglot();
	$loglot->setAccount($account);
	$loglot->setLotno($lotno);
	$loglot->setModelno($modelno);
	$loglot->setStation($station[0]);
	$loglot->setStatus('completed');
	$loglot->setSamplingsize(0);
	$loglot->setLastUpdatedBy($name);
	$loglot->addLotLogpass();
	
	echo 'success_'.$lotno;

?>