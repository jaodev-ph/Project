<?php
include_once("../classes/feeder_receiving.php");
session_start();

$account = trim($_SESSION['account']);
$name = $_SESSION['name'];
$feederId = $_GET['feederId'];
$feederType = $_GET['feederType'];
$feederSize = $_GET['feederSize'];
$plantNoFeeder = $_GET['plantNoFeeder'];
$endorsedByIssuance = $name;
$receivedByIssuance = $_GET['receivedByIssuance'];
$process = $_GET['process'];





$feeder = new Receiving();
$feeder->setfeederId($feederId);
$feeder->setfeederType($feederType);
$feeder->setfeederSize($feederSize);
$feeder->setplantNoFeeder($plantNoFeeder);
$feeder->setendorsedByIssuance($endorsedByIssuance);
$feeder->setreceivedByIssuance($receivedByIssuance);
$feeder->setprocess($process);
// $feeder->setlastupdatedBy($lastupdatedBy);
// $feeder->setlastupdate($lastupdate);

$feeder->IssuanceInfo(); 

 

echo 'ok_'.$feeder->getfeederId()."_".$feeder->getfeederType()."_".$feeder->getfeederSize()."_".$feeder->getplantNoFeeder()."_".$feeder->getendorsedByIssuance()."_".$feeder->getreceivedByIssuance()."_".$feeder->getprocess();

?>