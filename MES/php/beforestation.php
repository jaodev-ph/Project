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
	$Card = new Card($account,$serialno[0]);

	$optstation = ModelRoute::getBeforeStations($account, $Card->getPartNo(), $Card->getCurtStage());
    for($i=0;$i<count($optstation);$i++){

        echo $optstation[$i]->getStation().",";
    
    }


?>