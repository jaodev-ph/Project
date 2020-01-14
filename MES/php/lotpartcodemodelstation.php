<?php

include_once("../classes/modelroute.php");
include_once("../classes/station.php");
include_once("../classes/model.php");
include_once("../classes/partcode.php");
session_start();


	$account = trim($_SESSION['account']);
	$modelno = $_GET['modelno'];
	$partcode =  explode("|",$_GET['partcode']);


	$partmodel = Partcode::getPartcodeModel($account,$partcode[0]);


	$ModelRoute = new ModelRoute();
	$ModelRoute->setAccount($account);
	$ModelRoute->setModelNo($partmodel);
	$ModelRoute->getLotStation();
	
	$Station = new Station();
    $Station->StationDetails($account,$ModelRoute->getStation());
    $discription = $ModelRoute->getStation().": ".$Station->getDescription();
    echo $discription."_".Model::getLotQuantity($account,$modelno)."_".$partmodel."_".$partcode[0];

?>