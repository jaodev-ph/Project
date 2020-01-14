<?php
include_once("../classes/feeder_receiving.php");
session_start();

$account = trim($_SESSION['account']);
$name = $_SESSION['name'];
$feederId = $_GET['feederId'];
$feederType = $_GET['feederType'];
$feederSize = $_GET['feederSize'];
$plantNoFeeder = $_GET['plantNoFeeder'];

// $endorsedByfeeder = $name;
$lastupdatedBy = $name;
// $lastupdate = $_GET['lastupdate'];



$feeder = new Receiving();
$feeder->setfeederId($feederId);
$feeder->setfeederType($feederType);
$feeder->setfeederSize($feederSize);
$feeder->setplantNoFeeder($plantNoFeeder);
// $feeder->setendorsedByfeeder($endorsedByfeeder);
$feeder->setlastupdatedBy($lastupdatedBy);
// $feeder->setlastupdate($lastupdate);

$feeder->FeederInfo();

 

echo 'ok_'.$feeder->getfeederId()."_".$feeder->getfeederType()."_".$feeder->getfeederSize()."_".$feeder->getplantNoFeeder()."_".$feeder->getlastupdatedBy();

?>