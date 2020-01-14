<?php
include_once("../classes/feeder_insert.php");

session_start();

$account = trim($_SESSION['account']);
$name = $_SESSION['name'];
$feederType = $_GET['feederType'];
// $feederSize = $_GET['feederSize'];
$lastupdatedBy = $name;

$feeder = new Insert;
$feeder->setfeederType($feederType);
// $feeder->setfeederSize($feederSize);
$feeder->setlastupdatedBy($lastupdatedBy);
$feeder->FeederInfo();
//echo 'ok_'.$feeder->getfeederId()."_".$feeder->getfeederType()."_".$feeder->getplantNoFeeder();
?> 