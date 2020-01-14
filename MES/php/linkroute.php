<?php

include_once("../classes/modelroute.php");
include_once("../classes/station.php");
session_start();


	$account = trim($_SESSION['account']);
	$modelno = $_GET['modelno'];
	$formodel = $_GET['formodel'];
	$SplitStation = explode(":",$_GET['station']);
	$result = "";

	if($formodel == 0){
	$Station = new Station();
	$SelectStation = ModelRoute::PassModelRoute($account,$modelno);
	for($i=0;$i<count($SelectStation);$i++){
	
		$Station->StationDetails($account,$SelectStation[$i]->getStation());
		
		$result .= $SelectStation[$i]->getStation().": ".$Station->getDescription()."_";
	}
	echo $result;
	}

	if($formodel == 1){
	$ModelRoute = new ModelRoute();
	$ModelRoute->setAccount($account);
	$ModelRoute->setStation($SplitStation[0]);
	$ModelRoute->getStationDetails();


	echo $ModelRoute->getLineStop();;
	}


?>