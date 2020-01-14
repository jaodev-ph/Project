<?php
include_once("../classes/feeder_add.php");
include_once("../classes/feeder_update.php");

$feederId = $_GET['feederId'];
$typeId = $_GET['typeId'];
$sizeId = $_GET['sizeId'];
$lineId = $_GET['lineId'];
$plantnoFeeder = $_GET['plantnoFeeder'];
$name = $_SESSION['name'];
$mode = $_GET['mode'];

if($mode=="Add"){
	$feeder = new Add;
	$feeder->setfeederId($feederId);
	$feeder->setfeederType($typeId);
	$feeder->setfeederSize($sizeId);
	$feeder->setline($lineId);
	$feeder->setplantNoFeeder($plantnoFeeder); 
	$feeder->setlastupdatedBy($name); 
	$feeder->AddId($mode);
}
else if($mode=="Update"){
	$feeder = new Update;
	$feeder->setfeederId($feederId);
	$feeder->setfeederType($typeId);
	$feeder->setfeederSize($sizeId);
	$feeder->setline($lineId);
	$feeder->setplantNoFeeder($plantnoFeeder); 
	$feeder->setlastupdatedBy($name);
	$feeder->UpdateId($mode);
}


?> 