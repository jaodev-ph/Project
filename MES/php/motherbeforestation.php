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
	$mother = new Mother($account,$serialno[0]);

	$optstation = ModelRoute::getBeforeStations($account, $mother->getPartNo(), $mother->getCurtStation());
    for($i=0;$i<count($optstation);$i++){

        echo $optstation[$i]->getStation().",";
    
    }


?>