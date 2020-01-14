<?php
include_once("../classes/batch.php");
include_once("../classes/serialformat.php");
include_once("../classes/logbatch.php");
include_once("../classes/station.php");
include_once("../classes/BatchRepair.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serialno = explode(" ",$_GET['serialno']);

	$rejectCount = BatchRepair::countReject($account,$serialno[0]);
	
	// alert($rejectCount);

	if($rejectCount == 'true'){

	$Repair = BatchRepair::GetAllReject($account,$serialno[0]);

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
		echo $Repair[$i]->getCurrQuantity().",";

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