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
	$total = $_GET['total'];

	$lotnumber = new Lotnumber();
	$lotnumber->setPartno($modelno);
	$lotnumber->setAccount($account);
	$lotnumber->setLotno($lotno);
	$lotnumber->setQuantity($total);
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
	$loglot->setSamplingsize($total);
	$loglot->setLastUpdatedBy($name);
	$loglot->addLotLogpass();
	
	echo 'success_'.$lotno;

?>