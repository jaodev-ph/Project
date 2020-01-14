<?php
include_once("../classes/feeder_receiving.php");

/*session_start();*/

$account = trim($_SESSION['account']);
$name = $_SESSION['name'];
$feederId = $_GET['feederId'];
$feederType = $_GET['feederType'];
$feederSize = $_GET['feederSize'];
$plantNoFeeder = $_GET['plantNoFeeder'];
$lastupdatedBy = $name;

$feeder = new Receiving;
$feeder->setfeederId($feederId);
$feeder->setfeederType($feederType);
$feeder->setfeederSize($feederSize);
$feeder->setplantNoFeeder($plantNoFeeder);
$feeder->setlastupdatedBy($lastupdatedBy); 

$feeder->EndorseInfo();
//echo 'ok_'.$feeder->getfeederId()."_".$feeder->getfeederType()."_".$feeder->getplantNoFeeder();
?> 