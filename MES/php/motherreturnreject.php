<?php

include_once("../classes/modelroute.php");
include_once("../classes/station.php");
include_once("../classes/mother.php");
include_once("../classes/logmother.php");
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
	$ModelRoute->getStationDetails();
	// $ModelRoute->getpreviousstage1($account,$Model,$ModelRoute->getFlowsequence())

	$Card = new Mother();
	$Card->setAccount($account);
	$Card->setCardNo($serialno[0]);
	$Card->setStatus('GOOD');
	$Card->setCurtStation($ModelRoute->getpreviousstage2($account,$Model,$ModelRoute->getFlowsequence()));
	$Card->setLastUpdatedBy($name);
	$Card->updateStatus();
	

		$LogMother = new LogMother();
		$LogMother->setAccount($account);
		$LogMother->setLine($line);
		$LogMother->setMotherSerial($serialno[0]);
		$LogMother->setChildPartNo('');
		$LogMother->setStage($station[0]);
		$LogMother->setStatus('GOOD');
		$LogMother->setLastUpdatedBy($name);
		$LogMother->setCurrquantity(0);
		$LogMother->setDisquantity(0);
		$LogMother->setRemarks('RETURN TO '.$ModelRoute->getpreviousstage2($account,$Model,$ModelRoute->getFlowsequence()));
		$LogMother->addLogMother();

	echo 'successReturn_'.$serialno[0];



?>