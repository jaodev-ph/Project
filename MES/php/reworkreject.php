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
	
	$trackRepair = json_decode($_GET['trackRepair']);
	$trackremarks = json_decode($_GET['trackremarks']);


	for($i=0;$i<count($trackRepair);$i++){
		$trackRepair1 = $trackRepair[$i];
		$trackremarks1 = $trackremarks[$i];
		Repair::updateRepair($account,$trackRepair1,$serialno[0],$name,$trackremarks1);

	}

	$rejectCount = Repair::countReject($account,$serialno[0]);
	

	if($rejectCount == 'false'){

	$Logpass = new LogPass();
	$Logpass->setAccount($account);
	$Logpass->setLine($line);
	$Logpass->setCardNo($serialno[0]);
	$Logpass->setSequence(0);
	$Logpass->setMachine('');
	$Logpass->setStation($station[0]);
	$Logpass->setStatus('REPAIRED');
	$Logpass->setLastUpdatedBy($name);
	$Logpass->addLogpass();

	}

	echo 'success_'.$serialno[0];



?>