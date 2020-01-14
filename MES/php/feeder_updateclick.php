<?php
include_once("../classes/feeder_insert.php");
include_once("../classes/feeder_receiving.php");

session_start();

$account = trim($_SESSION['account']);
$name = $_SESSION['name'];
$feederId = $_GET['feederId'];
$feederType = $_GET['feederType'];
$feederSize = $_GET['feederSize'];
$plantNoFeeder = $_GET['plantNoFeeder'];
$lastupdatedBy = $name;
$lastupdate = $_GET['lastupdate'];


$feeder = new Insert();
$feeder->setfeederId($feederId);
$feeder->setfeederType($feederType);
$feeder->setfeederSize($feederSize);
$feeder->setplantNoFeeder($plantNoFeeder);
$feeder->setlastupdatedBy($lastupdatedBy); 
$feeder->setlastupdate($lastupdate);
$feeder->Update();
$feeder->Update2();
  

echo 'ok_'.$feeder->getfeederId()."_".$feeder->getfeederType()."_".$feeder->getfeederSize()."_".$feeder->getplantNoFeeder()."_".$feeder->getlastupdatedBy()."_".$feeder->getlastupdatedBy();
?> 