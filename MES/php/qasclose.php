<?php

include_once("../classes/modelroute.php");
include_once("../classes/station.php");
include_once("../classes/model.php");
include_once("../classes/lotnumber.php");
include_once("../classes/loglot.php");
include_once("../classes/card.php");
include_once("../classes/logpass.php");
session_start();


	$account = trim($_SESSION['account']);
	$modelno = $_GET['modelno'];
	$station = explode(":",$_GET['station']);
	$name = $_SESSION['name'];
	$lotno = $_GET['lotno'];
	$samplingCount = $_GET['samlingCount'];
	$hserialno = json_decode($_GET['hserialno']);


	$lotnumber = new Lotnumber();
	$lotnumber->setPartno($modelno);
	$lotnumber->setAccount($account);
	$lotnumber->setLotno($lotno);
	$lotnumber->setStatus('GOOD');
	$lotnumber->setSamplingSize($samplingCount);
	$lotnumber->setStage($station[0]);
	$lotnumber->setLastUpdatedBy($name);
	$lotnumber->updateLotQas();



	$loglot = new Loglot();
	$loglot->setAccount($account);
	$loglot->setLotno($lotno);
	$loglot->setModelno($modelno);
	$loglot->setStation($station[0]);
	$loglot->setStatus('GOOD');
	$loglot->setSamplingsize($samplingCount);
	$loglot->setLastUpdatedBy($name);
	$loglot->addLotLogpass();

	for($x=0;$x<count($hserialno);$x++)
	{


			$Card = new Card();
			$Card->setAccount($account);
			$Card->setCardNo($hserialno[$x]);
			$Card->setStatus('GOOD');
			$Card->setCurtStage($station[0]);
			$Card->setLastUpdatedBy($name);
			$Card->updateStatus();

			$Logpass = new LogPass();
			$Logpass->setAccount($account);
			$Logpass->setLine('');
			$Logpass->setCardNo($hserialno[$x]);
			$Logpass->setSequence(0);
			$Logpass->setMachine('');
			$Logpass->setStation($station[0]);
			$Logpass->setStatus('GOOD');
			$Logpass->setLastUpdatedBy($name);
			$Logpass->addLogpass();

	}
	
	echo 'success_'.$lotno;

?>