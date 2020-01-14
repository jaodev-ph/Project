<?php

include_once("../classes/modelroute.php");
include_once("../classes/station.php");
include_once("../classes/card.php");
include_once("../classes/logpass.php");
include_once("../classes/repair.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serialno = explode(" ",$_GET['serialno']);
	$line ='';
	$station = explode(":",$_GET['station']);
	$newstation = explode(":",$_GET['newstation']);
	$Model = $_GET['model'];

	$ModelRoute = new ModelRoute();
	$ModelRoute->setAccount($account);
	$ModelRoute->setStation($newstation[0]);
	$ModelRoute->setModelNo($Model);
	$ModelRoute->getStationDetails2();
	// $ModelRoute->getpreviousstage1($account,$Model,$ModelRoute->getFlowsequence())

	$Card = new Card();
	$Card->setAccount($account);
	$Card->setCardNo($serialno[0]);
	$Card->setStatus('GOOD');
	$Card->setCurtStage($ModelRoute->getpreviousstage2($account,$Model,$ModelRoute->getFlowsequence()));
	$Card->setLastUpdatedBy($name);
	$Card->updateStatus();
	

	$Logpass = new LogPass();
	$Logpass->setAccount($account);
	$Logpass->setLine('');
	$Logpass->setCardNo($serialno[0]);
	$Logpass->setSequence(0);
	$Logpass->setMachine('');
	$Logpass->setStation('RETURN TO '.$newstation[0]);
	$Logpass->setStatus('GOOD');
	$Logpass->setLastUpdatedBy($name);
	$Logpass->addLogpass();


	echo 'successReturn_'.$serialno[0];



?>