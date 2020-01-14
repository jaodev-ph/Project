<?php

include_once("../classes/modelroute.php");
include_once("../classes/station.php");
include_once("../classes/mother.php");
include_once("../classes/logmother.php");
include_once("../classes/motherrepair.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serialno = explode(" ",$_GET['serialno']);
	$line ='';
	$station = explode(":",$_GET['station']);

	$rejectdetails = MotherRepair::GetAllReject2($account,$serialno[0]);
	
	$trackRepair = json_decode($_GET['trackRepair']);
	$trackremarks = json_decode($_GET['trackremarks']);
	

	for($i=0;$i<count($trackRepair);$i++){
		$trackRepair1 = $trackRepair[$i];
		$trackremarks1 = $trackremarks[$i];
		
		MotherRepair::updateRepair($account,$trackRepair1,$serialno[0],$name,$trackremarks1);

	}

	$rejectCount = MotherRepair::countReject($account,$serialno[0]);
	

	if($rejectCount == 'false'){

	$Logpass = new LogMother();
	$Logpass->setAccount($account);
	$Logpass->setLine($line);
	$Logpass->setMotherSerial($serialno[0]);
/*	$Logpass->setSequence(0);
	$Logpass->setMachine('');*/
	$Logpass->setCurrquantity(0);
	$Logpass->setChildPartno('');
	$Logpass->setDisquantity(0);
	$Logpass->setStage($station[0]);
	$Logpass->setStatus('REPAIRED');
	$Logpass->setLastUpdatedBy($name);
	$Logpass->addLogMother();

	}

	echo 'success_'.$serialno[0];



?>