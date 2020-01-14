<?php
include_once("../classes/feeder_receiving.php");

session_start();

$account = trim($_SESSION['account']); 
$name = $_SESSION['name'];
$feederId = $_GET['feederId'];
$feederType = $_GET['feederType'];
$feederSize = $_GET['feederSize'];
$plantNoFeeder = $_GET['plantNoFeeder'];
$receivedByfeeder = $name;
$endorsedByfeeder = $_GET['endorsedByfeeder'];
$checker='';


$feeder = new Receiving();
$feeder->setfeederId($feederId);
$feeder->setfeederType($feederType);
$feeder->setfeederSize($feederSize);
$feeder->setplantNoFeeder($plantNoFeeder);
$feeder->setendorsedByfeeder($endorsedByfeeder);
$feeder->setreceivedByfeeder($receivedByfeeder);


$feeder->EndorseInfo(); 
// $feeder->LogReceiving();

//echo 'ok_'.$feeder->getfeederId()."_".$feeder->getfeederType()."_".$feeder->getplantNoFeeder();
?> 