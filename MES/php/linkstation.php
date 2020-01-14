<?php

include_once("../classes/modelroute.php");
include_once("../classes/station.php");
include_once("../classes/model.php");
session_start();


	$account = trim($_SESSION['account']);
	$modelno = $_GET['modelno'];

	$ModelRoute = new ModelRoute();
	$ModelRoute->setAccount($account);
	$ModelRoute->setModelNo($modelno);
	$ModelRoute->getLinkStation();
	

	$Station = new Station();
    $Station->StationDetails($account,$ModelRoute->getStation());
    $description = $ModelRoute->getStation().": ".$Station->getDescription();
    echo $description."_".Model::getLotQuantity($account,$modelno);

?>