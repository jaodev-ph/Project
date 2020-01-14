<?php

include_once("../classes/mother.php");
include_once("../classes/serialformat.php");
include_once("../classes/logmother.php");
include_once("../classes/station.php");
include_once("../classes/repair.php");
include_once("../classes/motherrepair.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serialno = explode(" ",$_GET['serialno']);

	$rejectCount = Repair::countReject($account,$serialno[0]);
	
	// alert($rejectCount);

	if($rejectCount == 'true'){

	$Repair = Repair::GetAllReject($account,$serialno[0]);

	for($i=0;$i<count($Repair);$i++){
		echo $Repair[$i]->getTrackingNo().",";

	}
	echo "_";
	for($i=0;$i<count($Repair);$i++){
		echo trim($Repair[$i]->getCategory()).",";

	}
	echo "_";
	for($i=0;$i<count($Repair);$i++){
		echo trim($Repair[$i]->getDefect()).",";

	}
	echo "_";
	for($i=0;$i<count($Repair);$i++){
		echo $Repair[$i]->getLocation().",";

	}
	echo "_";
	for($i=0;$i<count($Repair);$i++){
		echo $Repair[$i]->getDetails().",";
	}

	}else{
		echo 'false_';
	}
		

	

?>