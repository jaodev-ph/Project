<?php

include_once("../classes/motherrepair.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serialno = explode(" ",$_GET['serialno']);

	$rejectCount = MotherRepair::countReject($account,$serialno[0]);
	
	// alert($rejectCount);

	if($rejectCount == 'true'){

	$Repair = MotherRepair::GetAllReject($account,$serialno[0]);

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
		echo trim($Repair[$i]->getChildPartno()).",";

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