<?php
include_once("../classes/feeder_maintenance.php");
session_start();

$fType = $_GET['feederType'];
$fSize = $_GET['fSizePart'];
$name = $_SESSION['name'];
$result = "";

$feeder = new Maintenance;
$feeder1 = Maintenance::getAllParts($fSize,$fType);

	for($i=0;$i<count($feeder1);$i++){
		
		$result .= $feeder1[$i]->getfeederDescription().": ".$feeder1[$i]->getfeederPn()."_";
	}

	echo $result;


?> 