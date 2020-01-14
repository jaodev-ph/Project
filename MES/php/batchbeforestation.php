<?php

include_once("../classes/modelroute.php");
include_once("../classes/station.php");
include_once("../classes/batch.php");
include_once("../classes/logbatch.php");
include_once("../classes/repair.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serialno = explode(" ",$_GET['serialno']);
	$Batch = new Batch($account,$serialno[0]);

	$optstation = ModelRoute::getBeforeStations($account, $Batch->getPartNo(), $Batch->getCurtStage());
    for($i=0;$i<count($optstation);$i++){

        echo $optstation[$i]->getStation().",";
    
    }


?>