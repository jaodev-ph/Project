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
	$ModelRoute->getQASOBAstation();
	

	$Station = new Station();
    $Station->StationDetails($account,$ModelRoute->getStation());
    $discription = $ModelRoute->getStation().": ".$Station->getDescription();
    echo $discription."_".Model::getLotQuantity($account,$modelno);

?>