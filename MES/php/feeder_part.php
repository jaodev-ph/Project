<?php
include_once("../classes/feeder_maintenance.php");
session_start();
$feederPn = $_GET['feederPn'];
$typeParts = $_GET['typeParts'];
$sizeParts = $_GET['sizeParts'];
$feederDescription = $_GET['feederDescription'];
$name = $_SESSION['name'];
$mode = $_GET['mode'];
$id = $_GET['id'];

if($mode =="Add"){

	$feeder = new Maintenance;
	$feeder->setfeederPn($feederPn);
	$feeder->setfeederType($typeParts);
	$feeder->setfeederSize($sizeParts);
	$feeder->setfeederDescription($feederDescription); 
	$feeder->setlastupdatedBy($name); 
	$feeder->InsertParts($feeder->setfeederPn($feederPn));
}
else if ($mode=="Update")
{
	$feeder = new Maintenance;
	$feeder->setfeederPn($id);
	$feeder->setfeederType($typeParts);
	$feeder->setfeederSize($sizeParts);
	$feeder->setfeederDescription($feederDescription); 
	$feeder->setlastupdatedBy($name); 
	$feeder->UpdateParts($feederPn);
}

?> 